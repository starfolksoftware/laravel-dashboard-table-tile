<x-dashboard-tile :position="$position">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">
                    {{ $table->title }}
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    {{ $table->description }}
                </p>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="shadow-sm ring-1 ring-black ring-opacity-5">
                        <table class="min-w-full border-separate" style="border-spacing: 0">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach($table->columns as $column)
                                    @if ($loop->first)
                                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                        {{ $column['label'] }}
                                    </th>
                                    @else
                                    <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                        {{ $column['label'] }}
                                    </th>
                                    @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($table->rows as $row)
                                <tr>
                                    @foreach($table->columns as $columnKey => $columnValue)
                                    @if ($loop->first)
                                    <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                        {{ $row[$columnKey] }}
                                    </td>
                                    @else
                                    <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 hidden sm:table-cell">
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
</x-dashboard-tile>