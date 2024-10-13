<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Saldo Bulanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <!-- Button to trigger the recap process -->
                    <a href="{{ route('recap-all-data') }}" class="btn btn-primary mb-3 dark:text-gray-400">Recap Today's Data</a>

                      <!-- Date filter form -->
                    <form method="GET" action="{{ route('recaps') }}" class="mb-4">
                        <div class="flex items-center space-x-2">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" id="start_date" name="start_date" value="{{ $startDate ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" id="end_date" name="end_date" value="{{ $endDate ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700">
                            </div>
                            <div class="pt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Table to display recap data -->
                    <table id="satuanTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                            <tr>
                                <th rowspan="2" class="px-6 py-3">Date</th>
                                <th rowspan="2" class="px-6 py-3">Nomor Item</th>
                                <th rowspan="2" class="px-6 py-3">Kode Log</th>
                                <th rowspan="2" class="px-6 py-3">Nama Barang</th>
                                <th colspan="2" class="px-6 py-3">Saldo Awal</th>
                                <th colspan="2" class="px-6 py-3">Barang Masuk</th>
                                <th colspan="2" class="px-6 py-3">Barang Keluar</th>
                                <th colspan="2" class="px-6 py-3">Saldo Akhir</th>
                            </tr>
                            <tr>
                                <th class="px-6 py-3">Qty</th>
                                <th class="px-6 py-3">Rp</th>
                                <th class="px-6 py-3">Qty</th>
                                <th class="px-6 py-3">Rp</th>
                                <th class="px-6 py-3">Qty</th>
                                <th class="px-6 py-3">Rp</th>
                                <th class="px-6 py-3">Qty</th>
                                <th class="px-6 py-3">Rp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($recaps->isEmpty())
                                <tr>
                                    <td colspan="20">No recap data available.</td>
                                </tr>
                            @else
                                @foreach ($recaps as $recap)
                                    <tr> 
                                        <td>{{ \Carbon\Carbon::parse($recap->recap_date)->format('d-m-Y') }}</td>
                                        <td>{{ $recap->no_item }}</td>
                                        <td>{{ $recap->kode_log }}</td>
                                        <td>{{ $recap->nama_barang }}</td>
                                        <td>{{ $recap->jumlah - $recap->entry + $recap->exit }}</td>
                                        <td>{{'Rp. ' . number_format($recap->jumlah - $recap->entry + $recap->exit, 0, ',', '.') * $recap->harga }}</td>
                                        <td>{{ $recap->entry }}</td>
                                        <td>{{'Rp. ' . number_format($recap->harga * $recap->entry, 0, ',', '.' )}}</td>
                                        <td>{{ $recap->exit }}</td>
                                        <td>{{'Rp. ' . number_format($recap->harga * $recap->entry, 0, ',', '.' )}}</td>
                                        <td>{{ $recap->jumlah }}</td>
                                        <td>{{'Rp. ' . number_format($recap->harga * $recap->jumlah, 0, ',', '.' )}}</td>
                                    </tr> 
                                @endforeach
                            @endif
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
          <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024 <a href="http://atmi.co.id" class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.
        </span>
        @include('clock')
        </div>
    </footer>
</x-app-layout>
