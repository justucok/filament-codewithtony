<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subWeek()))
                ->badge(fn(Builder $query) => $query->where('date_hired', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subMonth()))
                ->badge(fn(Builder $query) => $query->where('date_hired', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subYear()))
                ->badge(fn(Builder $query) => $query->where('date_hired', '>=', now()->subYear())->count()),
        ];
    }
}
