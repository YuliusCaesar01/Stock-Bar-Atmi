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
                    <div class="mb-4 bg-white p-4 rounded shadow">
                        <form method="GET" action="{{ route('logs') }}" class="flex flex-wrap gap-2">
                            <!-- Top row with date filters -->
                            <div class="w-full flex gap-2 mb-2">
                                <div class="flex flex-col">
                                    <label for="start_date" class="text-xs text-gray-700">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" 
                                           class="px-2 py-1 border rounded text-xs text-gray-700">
                                </div>
                                
                                <div class="flex flex-col">
                                    <label for="end_date" class="text-xs text-gray-700">End Date</label>
                                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" 
                                           class="px-2 py-1 border rounded text-xs text-gray-700">
                                </div>
                            </div>
                            
                            <!-- Second row with all other filters, each with the same width -->
                            <div class="flex flex-col w-32">
                                <label for="no_barang" class="text-xs text-gray-700">No Item</label>
                                <select id="no_barang" name="no_barang" class="px-2 py-1 border rounded text-sm text-gray-700 w-full">
                                    <option value="">All</option>
                                    @foreach($noBarangs as $noBarang)
                                        <option class="text-xs text-gray-700" value="{{ $noBarang }}" {{ request('no_barang') == $noBarang ? 'selected' : '' }}>{{ $noBarang }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="flex flex-col w-32">
                                <label for="kd_log" class="text-xs text-gray-700">Kode Log</label>
                                <select id="kd_log" name="kd_log" class="px-2 py-1 border rounded text-sm text-gray-700 w-full">
                                    <option value="">All</option>
                                    @foreach($kdLogs as $kdLog)
                                        <option class="text-xs text-gray-700" value="{{ $kdLog }}" {{ request('kd_log') == $kdLog ? 'selected' : '' }}>{{ $kdLog }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex flex-col w-32">
                                <label for="nama_barang" class="text-xs text-gray-700">Nama Barang</label>
                                <select id="nama_barang" name="nama_barang" class="px-2 py-1 border rounded text-sm text-gray-700 w-full">
                                    <option value="">All</option>
                                    @foreach($namaBarangs as $namaBarang)
                                        <option class="text-xs text-gray-700" value="{{ $namaBarang }}" {{ request('nama_barang') == $namaBarang ? 'selected' : '' }}>{{ $namaBarang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex flex-col w-32">
                                <label for="order_number" class="text-xs text-gray-700">Order Number</label>
                                <select id="order_number" name="order_number" class="px-2 py-1 border rounded text-sm text-gray-700 w-full">
                                    <option value="">All</option>
                                    @foreach($orderNumbers as $orderNumber)
                                        <option class="text-xs text-gray-700" value="{{ $orderNumber }}" {{ request('order_number') == $orderNumber ? 'selected' : '' }}>{{ $orderNumber }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex flex-col w-32">
                                <label for="no_item" class="text-xs text-gray-700">Item Number</label>
                                <select id="no_item" name="no_item" class="px-2 py-1 border rounded text-sm text-gray-700 w-full">
                                    <option value="">All</option>
                                    @foreach($noItems as $noItem)
                                        <option class="text-xs text-gray-700" value="{{ $noItem }}" {{ request('no_item') == $noItem ? 'selected' : '' }}>{{ $noItem }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex flex-col w-32">
                                <label for="operator" class="text-xs text-gray-700">Operator</label>
                                <select id="operator" name="operator" class="px-2 py-1 border rounded text-sm text-gray-700 w-full">
                                    <option value="">All</option>
                                    @foreach($operators as $operator)
                                        <option class="text-xs text-gray-700" value="{{ $operator }}" {{ request('operator') == $operator ? 'selected' : '' }}>{{ $operator }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="flex flex-col w-32">
                                <label for="no_po" class="text-xs text-gray-700">Nomor PO</label>
                                <input type="text" id="no_po" name="no_po" value="{{ request('no_po') }}" 
                                       class="px-2 py-1 border rounded text-xs text-gray-700 w-full" placeholder="Filter by PO">
                            </div>
                            
                            <div class="flex flex-col w-32">
                                <label for="action" class="text-xs text-gray-700">Status</label>
                                <select id="action" name="action" class="px-2 py-1 border rounded text-xs text-gray-700 w-full">
                                    <option value="">All</option>
                                    <option class="text-xs text-gray-700" value="entry" {{ request('action') == 'entry' ? 'selected' : '' }}>Barang Masuk</option>
                                    <option class="text-xs text-gray-700" value="exit" {{ request('action') == 'exit' ? 'selected' : '' }}>Barang Keluar</option>
                                </select>
                            </div>
                            
                            <div class="flex items-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded text-sm">
                                    Filter
                                </button>
                                <a href="{{ route('logs') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded text-sm ml-2">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                    <table id="reportTable" class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">QR Code Barang</th>
                                {{-- <th scope="col" class="px-6 py-3">ID Barang</th> --}}
                                <th scope="col" class="px-6 py-3">No Item</th>
                                <th scope="col" class="px-6 py-3">Kode Log</th>
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
                            @foreach ($logs as $log)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        {!! QrCode::size(50)->generate($log->barang->no_barcode) !!}
                                    </td>
                                    {{-- <td class="px-6 py-4">{{ $log->barang_id }}</td> --}}
                                    <td class="px-6 py-4">{{ $log->no_barang }}</td>
                                    <td class="px-6 py-4">{{ $log->kd_log }}</td>
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
                        <tfoot>
                            <tr>
                                <td colspan="10" class="text-right">Total Harga:</td>
                                <td id="total-harga">Rp 50.000</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calculate total harga
            const rows = document.querySelectorAll('tbody tr');
            let totalHarga = 0;
            
            rows.forEach(row => {
                const hargaCell = row.querySelector('td:nth-child(12)');
                const quantityCell = row.querySelector('td:nth-child(14)');
                
                if (hargaCell && quantityCell) {
                    const harga = parseFloat(hargaCell.textContent.replace(/[^\d.-]/g, '')) || 0;
                    const quantity = parseFloat(quantityCell.textContent) || 0;
                    totalHarga += harga * quantity;
                }
            });
            
            document.getElementById('total-harga').textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(totalHarga);
        });
        </script>
</x-app-layout>
