<?php

namespace StarfolkSoftware\TableTile;

use Spatie\Dashboard\Models\Tile;

class TableStore
{
    private Tile $tile;

    /**
     * Create a new instance of the TableStore.
     * 
     * @param string $tileName
     * @return $this
     */
    public static function make(string $tileName)
    {
        return new static($tileName);
    }

    /**
     * Instantiate a new TableStore instance.
     * 
     * @param string $tileName
     * @return void
     */
    public function __construct(string $tileName)
    {
        $this->tile = Tile::firstOrCreateForName($tileName);
    }

    public function setData(array $data, string $key = 'data'): self
    {
        $this->tile->putData($key, $data);

        return $this;
    }

    public function getData(string $key = 'data'): array
    {
        return$this->tile->getData($key) ?? [];
    }
}
