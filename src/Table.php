<?php

namespace StarfolkSoftware\TableTile;

abstract class Table
{
    /**
     * The title of the table.
     * 
     * @var string
     */
    public $title;

    /**
     * The description of the table.
     * 
     * @var string
     */
    public $description;

    /**
     * The columns to be displayed in the table.
     * 
     * @var array
     */
    public $columns;

    /**
     * The rows to be displayed in the table.
     * 
     * @var array
     */
    public $rows;

    /**
     * The filters that can be applied to the table.
     * 
     * @var array
     */
    public $availableFilters = [];

    /**
     * The columns that can be searched.
     * 
     * @var array
     */
    public $searchableColumns = [];

    /**
     * Instantiate a new Table instance.
     * 
     * @param array $currentFilters
     * @param string $searchQuery
     * @return void
     */
    public function __construct(array $currentFilters = [], string $searchQuery = '')
    {
        $this->title = $this->getTitle();
        $this->description = $this->getDescription();
        $this->columns = $this->getColumns();
        $this->rows = $this->getRows();
        $this->availableFilters = $this->getAvailableFilters();
        $this->searchableColumns = $this->getSearchableColumns();
        
        if (! empty($currentFilters)) {
            $this->applyFilters($currentFilters);
        }
        
        if ($searchQuery) {
            $this->applySearchQuery($searchQuery);
        }
    }

    /**
     * Get the title of the table.
     * 
     * @return string
     */
    abstract protected function getTitle();

    /**
     * Get the description of the table.
     * 
     * @return string
     */
    abstract protected function getDescription();

    /**
     * Get the columns to be displayed in the table.
     * 
     * @return array
     */
    abstract protected function getColumns();

    /**
     * Get the rows to be displayed in the table.
     * 
     * @return array
     */
    abstract protected function getRows();

    /**
     * Get the filters to be applied to the table.
     * 
     * @return array
     */
    protected function getAvailableFilters()
    {
        return [];
    }

    /**
     * Get the columns that can be searched.
     * 
     * @return array
     */
    protected function getSearchableColumns()
    {
        return [];
    }

    /**
     * Apply the filters to the table.
     * 
     * @param array $currentFilters
     * @return void
     */
    protected function applyFilters(array $currentFilters)
    {
        if (empty($currentFilters)) {
            return;
        }

        collect($this->availableFilters)->each(function ($filter, $key) use ($currentFilters) {
            if (!empty($currentFilters[$key])) {
                $this->rows = collect($this->rows)->filter(function ($row) use ($key, $currentFilters) {
                    return in_array($row[$key], $currentFilters[$key]);
                });
            }
        });
    }

    /**
     * Apply search to the table.
     * 
     * @param string $query
     * @return void
     */
    protected function applySearchQuery(string $query)
    {
        if (! $query) {
            return;
        }

        $this->rows = collect($this->rows)->filter(function ($row) use ($query) {
            return collect($this->searchableColumns)->contains(function ($column) use ($row, $query) {
                return str_contains($row[$column], $query);
            });
        });
    }
}