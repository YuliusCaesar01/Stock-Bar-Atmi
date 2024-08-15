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
                    <input type="date" id="minDate" name="minDate" class="dark:text-gray-800">
                    <input type="date" id="maxDate" name="maxDate" class="dark:text-gray-800">
                    <table id="reportTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">QR Code Barang</th>
                                <th scope="col" class="px-6 py-3">ID Barang</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Order Number</th>
                                <th scope="col" class="px-6 py-3">Item Number</th>
                                <th scope="col" class="px-6 py-3">Operator</th>
                                <th scope="col" class="px-6 py-3">Satuan</th>
                                <th scope="col" class="px-6 py-3">Nomor PO</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $logs = \App\Models\BarangLog::get();
                            @endphp
                            @foreach ($logs as $log)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        {!! QrCode::size(50)->generate($log->barang->no_barcode) !!}
                                    </td>
                                    <td class="px-6 py-4">{{ $log->barang_id }}</td>
                                    <td class="px-6 py-4">{{ $log->barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $log->order_number }}</td>
                                    <td class="px-6 py-4">{{ $log->no_item }}</td>
                                    <td class="px-6 py-4">{{ $log->operator }}</td>
                                    <td class="px-6 py-4">{{ $log->satuan }}</td>
                                    <td class="px-6 py-4">{{ $log->no_po }}</td>
                                    <td class="px-6 py-4">{{ $log->harga }}</td>
                                    <td class="px-6 py-4">
                                        {{ $log->action === 'entry' ? 'Barang Masuk' : ($log->action === 'exit' ? 'Barang Keluar' : 'Unknown Action: ' . $log->action) }}
                                    </td>
                                    <td class="px-6 py-4">{{ $log->quantity }}</td>
                                    <td class="px-6 py-4">{{ $log->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
              <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024 <a href="http://atmi.co.id" class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.</span>
              @include('clock')
            </div>
        </footer>
    </div>
</x-app-layout>
