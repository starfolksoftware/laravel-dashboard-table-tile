<?php

namespace StarfolkSoftware\TableTile;

use Livewire\Component;

class TableTileComponent extends Component
{
    public $position;

    public string $tableClass;

    public array $tableFilters;

    public int $refreshIntervalInSeconds;


    public function mount(
        string $position,
        string $tableClass,
        array $tableFilters = [],
        int $refreshIntervalInSeconds = null
    )
    {
        $this->position = $position;
        $this->tableClass = $tableClass;
        $this->tableFilters = $tableFilters;
        $this->refreshIntervalInSeconds = $refreshIntervalInSeconds ?? 
            config('dashboard.tiles.tables.refresh_interval_in_seconds');
    }
    
    
    public function render()
    {
        return view('dashboard-table-tiles::tile', [
            'wireId' => $this->id,
            'table' => new $this->tableClass,
        ]);
    }
}
