<x-dashboard-tile :position="$position">
    <div class="border border-gray-300 rounded-lg h-full w-full">
        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="-ml-4 -mt-4 flex justify-between items-center">
                <div class="ml-4 mt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $table->title }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $table->description }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Filters -->
        @if (!empty($table->searchableColumns) || !empty($table->availableFilters))
        <section x-data="{ open: false }" aria-labelledby="filter-heading" class="relative z-10 border-t border-b border-gray-200 grid items-center">
            <h2 id="filter-heading" class="sr-only">Filters</h2>
            @if (!empty($table->availableFilters))
            <div class="relative col-start-1 row-start-1 py-4">
                <div class="max-w-7xl mx-auto flex space-x-6 divide-x divide-gray-200 text-sm px-4 sm:px-6 lg:px-8">
                    <div>
                        <button @click="open = ! open; $refs.disclosure.classList.remove('hidden')" type="button" class="group text-gray-700 font-medium flex items-center" aria-controls="disclosure-1" aria-expanded="false">
                            <!-- Heroicon name: solid/filter -->
                            <svg class="flex-none w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            {{ $this->filter_count }} Filters
                        </button>
                    </div>
                    <div wire:loading.inline wire:target="state" class="pl-6">
                        Loading...
                    </div>
                </div>
            </div>
            <div x-show="open" x-transition x-ref="disclosure" class="hidden h-56 overflow-y-auto border-t border-gray-200 py-10" id="disclosure-1">
                <div class="relative max-w-7xl mx-auto gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8">
                    <div class="flex justify-evenly">
                        @foreach ($table->availableFilters as $filterKey => $filter)
                        <fieldset class="flex-1">
                            <legend class="block font-medium">{{ $filter['label'] }}</legend>
                            @foreach ($filter['values'] as $value)
                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                <div class="flex items-center text-base sm:text-sm">
                                    <input wire:model="state.filters.{{$filterKey}}" id="filter-{{$filterKey}}-{{$value}}" name="{{$filterKey}}[]" value="{{$value}}" type="checkbox" class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-{{$filterKey}}-{{$value}}" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        {{ $value }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </fieldset>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if (!empty($table->searchableColumns))
            <div class="col-start-1 row-start-1 py-4">
                <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative inline-block rounded-md">
                        <input wire:model="state.query" type="search" name="search" id="search" class="border focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 px-4 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="Start typing...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
        @endif
        <div class="px-4 h-full overflow-auto">
            <div class="flex flex-col mb-40">
                <div class="-my-2 -mx-4 overflow-x-hidden">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="">
                            <table wire:loading.remove wire:target="state" class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        @foreach($table->columns as $column)
                                        @if ($loop->first)
                                        <th scope="col" class="py-4 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $column['label'] }}
                                        </th>
                                        @endif
                                        @if ($loop->last)
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            {{ $column['label'] }}
                                        </th>
                                        @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($table->rows as $row)
                                    <tr class="odd:bg-white even:bg-gray-100">
                                        <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                            {{ $row[collect($table->columns)->keys()->first()] }}
                                            <dl class="font-normal space-y-2">
                                                @foreach($table->columns as $columnKey => $columnValue)
                                                @if (!$loop->last && !$loop->first)
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">{{ $columnValue['label'] }}</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $row[$columnKey] }}</dd>
                                                </div>
                                                @endif
                                                @endforeach
                                            </dl>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            {{ $row[collect($table->columns)->keys()->last()] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div wire:loading wire:target="state" class="w-full flex flex-col text-center">
                <svg class="w-16 h-16 ml-auto mr-auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <style>
                        @keyframes loader9 {
                            0% {
                                transform: translateY(0)
                            }

                            to {
                                transform: translateY(-6px);
                                fill: #0a0a30
                            }
                        }
                    </style>
                    <path stroke="#0A0A30" stroke-linecap="round" stroke-width="1.5" d="M10 15.749h4" />
                    <path fill="#265BFF" d="M10.5 12h3v3h-3z" style="animation:loader9 1s cubic-bezier(.72,.08,.38,.87) alternate infinite both" />
                </svg>
                <span class="text-base text-gray-400 italic">
                    Updating data...
                </span>
            </div>
        </div>
    </div>
</x-dashboard-tile>