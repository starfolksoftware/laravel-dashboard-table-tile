<?php

namespace StarfolkSoftware\TableTile;

use Livewire\Component;

class TableTileComponent extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'query' => '',
    ];

    /**
     * The position of the table tile.
     * 
     * @var string
     */
    public string $position;

    /**
     * The class of the table.
     * 
     * @var string
     */
    public string $tableClass;

    /**
     * The filters that should be applied to the table.
     * 
     * @var array
     */
    public array $tableFilters;

    /**
     * The refresh interval.
     * 
     * @var int
     */
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
