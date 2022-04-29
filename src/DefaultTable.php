<?php

namespace StarfolkSoftware\TableTile;

class DefaultTable extends Table
{
    /**
     * Get the title of the table.
     * 
     * @return string
     */
    protected function getTitle()
    {
        return 'Default Table Tile';
    }

    /**
     * Get the description of the table.
     * 
     * @return string
     */
    protected function getDescription()
    {
        return 'This is the default table tile. It is used to test the table tile.';
    }

    /**
     * Get the columns to be displayed in the table.
     * 
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => [
                'label' => 'Name',
            ],
            'email' => [
                'label' => 'Email',
            ],
            'gender' => [
                'label' => 'Gender',
            ],
            'status' => [
                'label' => 'Status',
            ],
        ];
    }

    /**
     * Get the rows to be displayed in the table.
     * 
     * @return array
     */
    protected function getRows()
    {
        $faker = \Faker\Factory::create();

        return collect(range(1, 100))->map(function ($i) use ($faker) {
            return [
                'name' => $faker->name,
                'email' => $faker->email,
                'gender' => $faker->randomElement(['male', 'female']),
                'status' => $faker->randomElement(['paid', 'unpaid']),
            ];
        });
    }

    /**
     * Get the filters to be applied to the table.
     * 
     * @return array
     */
    protected function getAvailableFilters()
    {
        return [
            'gender' => [
                'label' => 'Gender',
                'values' => [
                    'male',
                    'female',
                ],
            ],
            'status' => [
                'label' => 'Status',
                'values' => [
                    'paid',
                    'unpaid'
                ],
            ]
        ];
    }

    /**
     * Get the columns that can be searched.
     * 
     * @return array
     */
    protected function getSearchableColumns()
    {
        return ['name', 'email'];
    }
}