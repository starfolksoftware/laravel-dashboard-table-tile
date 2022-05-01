<?php

namespace StarfolkSoftware\TableTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class TableTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-table-tiles'),
        ], 'dashboard-table-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-table-tiles');

        Livewire::component('table-tile', TableTileComponent::class);
    }
}
