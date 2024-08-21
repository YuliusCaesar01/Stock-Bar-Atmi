<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight ">
            {{ __('Saldo Bulanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white ">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <input type="date" id="minDate" name="minDate" class="dark:text-gray-800">
                    <input type="date" id="maxDate" name="maxDate" class="dark:text-gray-800">
                    <table id="reportTable"
                        class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No. Item</th>
                                <th scope="col" class="px-6 py-3">Nama Item</th>
                                <th scope="col" class="px-6 py-3">Kode Log</th>
                                <th scope="col" class="px-6 py-3">Merk</th>
                                <th scope="col" class="px-6 py-3">Satuan</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Rak</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3">Jumlah Minimal</th>
                                <th scope="col" class="px-6 py-3">No Katalog</th>
                                <th scope="col" class="px-6 py-3">Merk</th>
                                <th scope="col" class="px-6 py-3">No Akun</th>
                                <th scope="col" class="px-6 py-3">QR(manual)</th>
                            </tr>
                        </thead>
                        
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
    </div>

   
</x-app-layout>
