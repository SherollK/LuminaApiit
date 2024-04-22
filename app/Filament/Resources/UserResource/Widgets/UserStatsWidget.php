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
            //admins
            Stat::make('Total Users', User::count()),
            Stat::make('Total Admins', User::whereIn('role', [
                User::ROLE_ADMIN,
                User::ROLE_EDITOR,
                User::ROLE_MODERATOR,
                User::ROLE_USER_MANAGER,
                User::ROLE_TAG_MANAGER,
                User::ROLE_ANALTIC 
            ])->count()),
            
            //Stat::make('Total Editors', User::where('role', User::ROLE_EDITOR)->count()),
            //Stat::make('Total Moderators', User::where('role', User::ROLE_MODERATOR)->count()),
            //Stat::make('Total User Management Admins', User::where('role', User::ROLE_USER_MANAGER)->count()),
            //Stat::make('Total Tag Mnanagement Admins', User::where('role', User::ROLE_TAG_MANAGER)->count()),
            //Stat::make('Total Analytical Admins', User::where('role', User::ROLE_ANALTIC)->count()),

            //users
            Stat::make('Total Students', User::where('role', User::ROLE_USER)->count()),
            Stat::make('Total Staff', User::where('role', User::ROLE_STAFF)->count()),
            Stat::make('Total Alumni', User::where('role', User::ROLE_ALUMNI)->count()),
        ];
    }
}
