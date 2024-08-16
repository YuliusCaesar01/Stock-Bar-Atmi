<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight ">
            {{ __('Report Jumlah Stock Barang') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            @php
                // Fetch all stock summaries
                $barangs = \App\Models\StockSummary::all();
            @endphp

            <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                <table id="tahunTable">
                    <div class="w-full text-sm text-center text-gray-500 dark:text-dark-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-dark-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Unit</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr class="bg-white border-b">
                                <td class="text-gray-700 text-center px-6 py-4">{{ $barang->date }}</td>
                                <td class="text-gray-700 text-center px-6 py-4">{{ $barang->kd_prod }}</td>
                                <td class="text-gray-700 text-center px-6 py-4">{{ $barang->total_stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
