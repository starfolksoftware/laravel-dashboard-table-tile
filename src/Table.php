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
     * The filters to be applied to the table.
     * 
     * @var array
     */
    public $filters = [];

    /**
     * Instantiate a new Table instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->title = $this->getTitle();
        $this->description = $this->getDescription();
        $this->columns = $this->getColumns();
        $this->rows = $this->getRows();
        $this->filters = $this->getFilters();
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
    protected function getFilters()
    {
        return [];
    }
}