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
                    <input type="date" id="minDate" name="minDate" class="dark:text-gray-800">
                    <input type="date" id="maxDate" name="maxDate" class="dark:text-gray-800">
                    <table id="satuanTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                            <tr>
                                <th>Barang</th>
                                <th>Entry</th>
                                <th>Exit</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockRecap->sortBy('summary_date') as $recap)
                                <tr>
                                    <td>{{ $recap->barang->nama_barang }}</td>
                                    <td>{{ $recap->total_entry }}</td>
                                    <td>{{ $recap->total_exit }}</td>
                                    <td>{{ $recap->summary_date }}</td>
                                </tr>
                            @endforeach
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
