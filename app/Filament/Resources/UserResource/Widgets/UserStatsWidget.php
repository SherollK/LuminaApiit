<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count()),
            Stat::make('Total Admins', User::where('role', User::ROLE_ADMIN)->count()),
            Stat::make('Total Content Manager Admins', User::where('role', User::ROLE_CONTENT_MNG)->count()),
            Stat::make('Total Category Manager Admins', User::where('role', User::ROLE_CATEGORY_MNG)->count()),
            Stat::make('Total User Manager Admins', User::where('role', User::ROLE_USER_MNG)->count()),
            Stat::make('Total Alumini Members', User::where('role', User::ROLE_ALUMINI)->count()),
            Stat::make('Total Students', User::where('role', User::ROLE_USER)->count()),
        ];
        
    }
}
