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
                                    <td colspan="5">No recap data available.</td>
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
