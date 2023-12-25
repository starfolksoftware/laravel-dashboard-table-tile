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

    /**
     * The table instance.
     * 
     * @var mixed
     */
    protected $table;

    /**
     * Mounts the component
     * 
     * @param string $position
     * @param string $tableClass
     * @param int $refreshIntervalInSeconds
     * @return void
     */
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

        $this->table = new $this->tableClass(
            $this->state['filters'],
            $this->state['query'],
        );
    }

    /**
     * Calculates current filters count.
     * 
     * @return int
     */
    public function getFilterCountProperty()
    {
        return collect($this->state['filters'])->map(function ($filter) {
            return count($filter);
        })->sum();
    }

    /**
     * Runs when the filters are updated.
     * 
     * @param mixed $value
     * @param mixed $key
     * @return void
     */
    public function updatedState($value, $key)
    {
        $this->table = new $this->tableClass(
            $this->state['filters'],
            $this->state['query'],
        );
    }
    
    public function render()
    {
        return view('dashboard-table-tiles::tile', [
            'wireId' => $this->id(),
            'table' => new $this->tableClass(
                $this->state['filters'],
                $this->state['query'],
            ),
        ]);
    }
}
