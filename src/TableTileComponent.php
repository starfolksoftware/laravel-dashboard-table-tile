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
        'filters' => [],
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
     * The refresh interval.
     * 
     * @var int
     */
    public int $refreshIntervalInSeconds;


    public function mount(
        string $position,
        string $tableClass = null,
        int $refreshIntervalInSeconds = null
    )
    {
        $this->position = $position;
        $this->tableClass = $tableClass ?? DefaultTable::class;
        $this->refreshIntervalInSeconds = $refreshIntervalInSeconds ?? 
            config('dashboard.tiles.tables.refresh_interval_in_seconds');

        $table = new $this->tableClass();

        $this->state['filters'] = collect($table->availableFilters)->mapWithKeys(function ($filter, $key) {
            return [$key => []];
        })->toArray();
    }
    
    
    public function render()
    {
        return view('dashboard-table-tiles::tile', [
            'wireId' => $this->id,
            'table' => new $this->tableClass(
                $this->state['filters'],
                $this->state['query'],
            ),
        ]);
    }
}
