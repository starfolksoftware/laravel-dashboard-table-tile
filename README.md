# Laravel Dashboard Table Tile

[![Latest Version on Packagist](https://img.shields.io/packagist/v/starfolksoftware/laravel-dashboard-table-tile.svg?style=flat-square)](https://packagist.org/packages/starfolksoftware/laravel-dashboard-table-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/starfolksoftware/laravel-dashboard-table-tile/run-tests?label=tests)](https://github.com/starfolksoftware/laravel-dashboard-table-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/starfolksoftware/laravel-dashboard-table-tile.svg?style=flat-square)](https://packagist.org/packages/starfolksoftware/laravel-dashboard-table-tile)

A simple and straightforward table tile package.

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

## Installation

You can install the package via composer:

```bash
composer require starfolksoftware/laravel-dashboard-table-tile
```

## Usage

In the dashboard config file, you can optionally add this configuration in the tiles key.

```php
'tiles' => [
    // ...
    'tables' => [
        'refresh_interval_in_seconds' => 300, // Default: 300 seconds (5 minutes)
    ],
],
```

See a table example below:

```php
<?php

namespace App\Tables;

use StarfolkSoftware\TableTile\Table;

class ExampleTableTile extends Table
{
    /**
     * Get the title of the table.
     * 
     * @return string
     */
    protected function getTitle()
    {
        return 'Example Table Tile';
    }

    /**
     * Get the description of the table.
     * 
     * @return string
     */
    protected function getDescription()
    {
        return 'This is an example table tile.';
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
```

In your dashboard view you use the `livewire:table-tile` component.

```html
<x-dashboard>
    <livewire:table-tile position="e7:e16" />
</x-dashboard>
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Faruk Nasir](https://github.com/frknasir)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
