<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\PaymentIntent;
use Stripe\Webhook;
use UnexpectedValueException;

class StripeWebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        $secret = config('services.stripe.webhook_secret');

        if (! $secret) {
            Log::warning('Stripe webhook received but STRIPE_WEBHOOK_SECRET is not configured.');

            return response('Webhook secret not configured', 503);
        }

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature', ''),
                $secret,
            );
        } catch (SignatureVerificationException|UnexpectedValueException $e) {
            Log::warning('Stripe webhook signature verification failed: ' . $e->getMessage());

            return response('Invalid signature', 400);
        }

        if ($event->type === 'payment_intent.succeeded') {
            $this->handlePaymentIntentSucceeded($event->data->object);
        }

        return response('OK', 200);
    }

    protected function handlePaymentIntentSucceeded(PaymentIntent $intent): void
    {
        $booking = Booking::where('stripe_payment_intent_id', $intent->id)->first();

        if ($booking) {
            if ($booking->status !== 'paid') {
                $booking->update(['status' => 'paid', 'paid_at' => now()]);
            }

            return;
        }

        $meta = $intent->metadata;

        if (! $meta || ! ($meta['email'] ?? null)) {
            Log::warning("Stripe webhook: payment_intent.succeeded ({$intent->id}) has no matching booking and insufficient metadata to create one.");

            return;
        }

        Booking::create([
            'service' => $meta['service'] ?? 'unknown',
            'trip_date' => $meta['trip_date'] ?? now()->toDateString(),
            'pickup_time' => $meta['pickup_time'] ?? '00:00',
            'passengers' => (int) ($meta['passengers'] ?? 1),
            'first_name' => $meta['first_name'] ?? '',
            'last_name' => $meta['last_name'] ?? '',
            'email' => $meta['email'],
            'phone' => $meta['phone'] ?? '',
            'pickup_location' => $meta['pickup_location'] ?? '',
            'payment_method' => 'card',
            'status' => 'paid',
            'amount_cents' => $intent->amount,
            'currency' => $intent->currency,
            'stripe_payment_intent_id' => $intent->id,
            'paid_at' => now(),
        ]);
    }
}
