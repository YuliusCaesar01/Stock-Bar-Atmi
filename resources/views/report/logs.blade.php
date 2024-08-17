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

    <!-- Include jQuery and DataTables JS/CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#LogTable').DataTable({
                scrollX: true,
                ordering: false,
                responsive: false,
                columnDefs: [{
                        width: '10%',
                        targets: 0
                    }, // Log Id
                    {
                        width: '30%',
                        targets: 1
                    }, // QR Code Barang
                    {
                        width: '15%',
                        targets: 2
                    }, // ID Barang
                    {
                        width: '15%',
                        targets: 3
                    }, // Nama Barang
                    {
                        width: '15%',
                        targets: 4
                    }, // Status
                    {
                        width: '15%',
                        targets: 5
                    }, // Quantity
                    {
                        width: '20%',
                        targets: 6
                    } // Timestamp
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'excel',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'pdf',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800'
                    },
                    {
                        extend: 'print',
                        className: 'bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-700 dark:hover:bg-blue-800',
                        customize: function(win) {
                            $(win.document.body).prepend(
                                '<div style="display:flex; text-align: center; justify-content: space-between; align-items: center; margin-bottom: 20px;"><img src="logopt1.png" style="width: 200px;"></div>'
                                );
                        }
                    }
                ],
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="select2"><option value=""></option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>');
                        });

                        // Initialize Select2
                        select.select2({
                            width: '100%',
                            dropdownAutoWidth: true,
                            allowClear: true,
                            placeholder: "Filter by " + $(column.header()).text(),
                        });
                    });
                }
            });

            // Prevent default sorting behavior on header click
            $('#tahunTable thead').on('click', 'th', function(e) {
                e.stopPropagation();
            });
        });
    </script>
</x-app-layout>
