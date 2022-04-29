<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use StarfolkSoftware\TableTile\Table;
use StarfolkSoftware\TableTile\Tests\TestCase;

uses(TestCase::class)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function makeTableClass()
{
    return new class extends Table
    {
        /**
         * Get the title of the table.
         * 
         * @return string
         */
        protected function getTitle()
        {
            return 'Custom Table Class';
        }

        /**
         * Get the description of the table.
         * 
         * @return string
         */
        protected function getDescription()
        {
            return 'This is a custom table class.';
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
                'gender' => [
                    'label' => 'Gender',
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

            return collect(range(1, 10))->map(function ($i) use ($faker) {
                return [
                    'name' => $faker->name,
                    'gender' => $faker->randomElement(['male', 'female']),
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
            ];
        }

        /**
         * Get the columns that can be searched.
         * 
         * @return array
         */
        protected function getSearchableColumns()
        {
            return ['name'];
        }
    };
}
