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
                    @foreach($summaryPerDay as $daySummary)
                    <h2>Summary for Date: {{ $daySummary->first()['summary_date'] }}</h2>
                    <table id="satuanTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                            <tr>
                                <th rowspan="2" scope="col" class="px-6 py-3">Nama Barang</th>
                                <th colspan="1" scope="col" class="px-6 py-3">Saldo Awal</th>
                                <th colspan="1" scope="col" class="px-6 py-3">Barang Masuk</th>
                                <th colspan="1" scope="col" class="px-6 py-3">Barang Keluar</th>
                                <th colspan="1" scope="col" class="px-6 py-3">Saldo Akhir</th>
                            </tr>
                            <tr>
                                <th scope="col" class="px-6 py-2">Qty</th>
                                <th scope="col" class="px-6 py-2">Qty</th>
                                <th scope="col" class="px-6 py-2">Qty</th>
                                <th scope="col" class="px-6 py-2">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daySummary as $barang)
                                <tr>
                                    <td>{{ $barang['nama_barang'] }}</td>
                                    <td>{{ $barang['stock_awal'] }}</td>
                                    <td>{{ $barang['barang_masuk'] }}</td>
                                    <td>{{ $barang['barang_keluar'] }}</td>
                                    <td>{{ $barang['stock_akhir'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
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
