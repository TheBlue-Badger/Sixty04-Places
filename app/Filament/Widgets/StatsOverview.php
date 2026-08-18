<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Enquiry;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Enquiries', Enquiry::where('status', 'new')->count())
                ->description('Awaiting a response')
                ->descriptionIcon('heroicon-m-envelope')
                ->icon('heroicon-o-inbox')
                ->color('warning'),
            Stat::make('Pending Bookings', Booking::where('status', 'pending')->count())
                ->description('Needs confirmation')
                ->descriptionIcon('heroicon-m-clock')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('warning'),
            Stat::make('Upcoming Bookings', Booking::where('trip_date', '>=', now())->count())
                ->description('Scheduled trips ahead')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->icon('heroicon-o-map')
                ->color('success'),
        ];
    }
}
