<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="LogTable"
                        class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Log Id</th>
                                <th scope="col" class="px-6 py-3">QR Code Barang</th>
                                <th scope="col" class="px-6 py-3">ID Barang</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Timestamp</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col" class="px-6 py-3">Log Id</th>
                                <th scope="col" class="px-6 py-3">QR Code Barang</th>
                                <th scope="col" class="px-6 py-3">ID Barang</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Timestamp</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $logs = \App\Models\BarangLog::get();
                                $barang = \App\Models\Barang::get();
                            @endphp
                            @foreach ($logs as $l)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 justify-center items-center">{{ $l->id }}</td>
                                    <td class="px-6 py-4 flex justify-center items-center">
                                        {!! QrCode::size(50)->generate($l->barang->no_barcode) !!}
                                    </td>
                                    <td class="px-6 py-4 justify-center items-center">{{ $l->barang_id }}</td>
                                    <td class="px-6 py-4 justify-center items-center">{{ $l->barang->nama_barang }}</td>
                                    <?php
                                    $action = '';
                                    if ($l->action === 'entry') {
                                        $action = 'Barang Masuk';
                                    } elseif ($l->action === 'exit') {
                                        $action = 'Barang Keluar';
                                    } else {
                                        $action = 'Unknown Action: ' . $l->action;
                                    }
                                    ?>
                                    <td class="px-6 py-4 justify-center items-center">{{ $action }}</td>
                                    <td class="px-6 py-4 justify-center items-center">{{ $l->quantity }}</td>
                                    <td class="px-6 py-4 justify-center items-center">{{ $l->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024 <a href="http://atmi.co.id"
                        class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.
                </span>
                @include('clock')
            </div>
        </footer>
    </div>
</x-app-layout>
