<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\Team;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count())
                ->description('All users in the system')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Teams', Team::query()->count())
                ->description('Teams registered')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Employees', Employee::query()->count())
                ->description('All employees in the system')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
