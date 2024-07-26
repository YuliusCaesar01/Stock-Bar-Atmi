<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Hak Akses Gudang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-dark-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex">
                    <!-- Left Panel -->
                    <div class="w-1/3 pr-4">
                        <div>
                            <label for="kode_log" class="block text-sm font-medium text-gray-700">Kode Log</label>
                            <input type="text" id="kode_log" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <label for="name_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas (WH)</label>
                            <input type="text" id="name_petugas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <input type="text" id="keterangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                            <select id="tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <!-- Add options here -->
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <input type="text" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <label for="kode_user" class="block text-sm font-medium text-gray-700">Kode User</label>
                            <input type="text" id="kode_user" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <label for="petugas_pembelian" class="block text-sm font-medium text-gray-700">Petugas Pembelian</label>
                            <input type="text" id="petugas_pembelian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mt-4">
                            <label for="plant" class="block text-sm font-medium text-gray-700">Plant</label>
                            <input type="text" id="plant" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <!-- Center Panel -->
                    <div class="w-1/3 pr-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Log</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plant</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Add table rows here -->
                                <!-- Example row: -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">C</td>
                                    <td class="px-6 py-4 whitespace-nowrap">MDC</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Electrical Std. Parts MDC</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Right Panel -->
                    <div class="w-1/3">
                        <div>
                            <label for="pilih_nama" class="block text-sm font-medium text-gray-700">Pilih Nama</label>
                            <select id="pilih_nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <!-- Add options here -->
                            </select>
                        </div>
                        <div class="mt-4 flex space-x-4">
                            <button class="px-4 py-2 bg-green-500 text-white rounded-md">Masuk</button>
                            <button class="px-4 py-2 bg-red-500 text-white rounded-md">Lepas</button>
                        </div>
                        <div class="mt-4">
                            <label for="user_name" class="block text-sm font-medium text-gray-700">User Name</label>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Add table rows here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-1/3 pr-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Log</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plant</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Add table rows here -->
                                <!-- Example row: -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">C</td>
                                    <td class="px-6 py-4 whitespace-nowrap">MDC</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Electrical Std. Parts MDC</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024 <a href="http://atmi.co.id" class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.</span>
            @include('clock')
        </div>
    </footer>
</x-app-layout>
