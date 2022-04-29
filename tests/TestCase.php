<?php

namespace StarfolkSoftware\TableTile\Tests;

use Livewire\LivewireServiceProvider;
use NunoMaduro\LaravelMojito\MojitoServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Dashboard\DashboardServiceProvider;
use StarfolkSoftware\TableTile\TableTileServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('dashboard.tiles.tables', [
            'refresh_interval_in_seconds' => 300,
        ]);

        $app['config']->set('app.key', 'base64:6Cu/ozj4gPtIjmXjr8EdVnGFNsdRqZfHfVjQkmTlg4Y=');
    }

    protected function getPackageProviders($app): array
    {
        return [
            DashboardServiceProvider::class,
            LivewireServiceProvider::class,
            MojitoServiceProvider::class,
            TableTileServiceProvider::class,
        ];
    }
}