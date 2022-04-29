<x-dashboard-tile :position="$position">
    <div class="border border-gray-300 rounded-lg h-full">
        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $table->title }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $table->description }}
                    </p>
                </div>
                <div class="ml-4 mt-4 flex-shrink-0">
                    <div class="mt-4 sm:mt-0 sm:ml-16 flex space-x-1">
                        <div>
                            <div class="relative rounded-md">
                                <input wire:model.defer="state.query" type="search" name="search" id="search" class="border focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 px-4 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="Start typing...">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }" class="relative inline-block text-left z-50">
                            <div>
                                <button @click="open = ! open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div x-show="open" x-transition @click.outside="open = false" class="origin-top-right absolute right-0 mt-2 w-56 border border-gray-300 rounded-md shadow bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-4 h-full overflow-auto">
            <div class="flex flex-col mb-16">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        @foreach($table->columns as $column)
                                        @if ($loop->first)
                                        <th scope="col" class="py-4 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            {{ $column['label'] }}
                                        </th>
                                        @else
                                        <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">
                                            {{ $column['label'] }}
                                        </th>
                                        @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($table->rows as $row)
                                    <tr class="odd:bg-white even:bg-gray-100">
                                        @foreach($table->columns as $columnKey => $columnValue)
                                        @if ($loop->first)
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $row[$columnKey] }}
                                        </td>
                                        @else
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $row[$columnKey] }}
                                        </td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-tile>