<?php

use Livewire\Livewire;
use StarfolkSoftware\TableTile\DefaultTable;
use StarfolkSoftware\TableTile\TableTileComponent;
use Livewire\Testing\TestableLivewire;
use NunoMaduro\LaravelMojito\ViewAssertion;

test('component can be mounted', function () {
    $component = new TableTileComponent();
    $component->mount('a1');

    $this->assertSame('a1', $component->position);
    $this->assertSame(DefaultTable::class, $component->tableClass);
    $this->assertSame($component->refreshIntervalInSeconds, 300);
});

test('component can be rendered', function () {
    /** @var TestableLivewire $result */
    $result = Livewire::test(TableTileComponent::class, ['position' => 'a1']);

    $wireId = $result->id();

    $result->assertViewHas('tableClass', DefaultTable::class)
        ->assertViewHas('refreshIntervalInSeconds', 300)
        ->assertViewHas('wireId', $wireId)
        ->assertSee("Default Table Tile");
});
