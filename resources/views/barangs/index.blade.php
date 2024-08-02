<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-dark-100 leading-tight ">
            {{ __('Daftar Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white :bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-3 relative border overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="barangTable"
                        class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-dark-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-dark-700 dark:text-dark-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">QR Code</th>
                                <th scope="col" class="px-6 py-3">Activity</th>
                                <th scope="col" class="px-6 py-3">No Item</th>
                                <th scope="col" class="px-6 py-3">Nama Barang</th>
                                <th scope="col" class="px-6 py-3">Kode Log</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
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
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr class="bg-gray-800 border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <img src="data:image/svg+xml;base64,{{ $barang->qr_code }}" alt="QR Code">
                                    </td>
                                    <td scope="row"
                                        class="flex items-center justify-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="inline-flex rounded-md shadow-sm">
                                            <a href="{{ route('barangs.show', $barang) }}" aria-current="page"
                                                class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 :bg-gray-800 dark:border-gray-200 dark:text-dark dark:hover:text-dark dark:hover:bg-gray-200 dark:focus:ring-blue-500 dark:focus:text-white">Detail</a>
                                            <div class="inline-flex rounded-md shadow-sm">
                                                <!-- Button to trigger the modal -->
                                                <button data-modal-target="entry-modal" data-modal-toggle="entry-modal"
                                                    onclick="setMaterialentryDetails('{{ $barang->id }}', '{{ $barang->nama_barang }}', '{{ $barang->no_barcode }}', '{{ $barang->jumlah }}', '{{ $barang->kode_log }}', '{{ $barang->harga }}')"
                                                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-200 dark:border-gray-200 dark:text-dark dark:hover:text-dark dark:hover:bg-gray-200 dark:focus:ring-blue-500 dark:focus:text-white">Tambah</button>
                                                <button data-modal-target="exit-modal" data-modal-toggle="exit-modal"
                                                    onclick="setMaterialDetails('{{ $barang->id }}', '{{ $barang->nama_barang }}', '{{ $barang->no_barcode }}', '{{ $barang->jumlah }}', '{{ $barang->kode_log }}', '{{ $barang->satuan }}', '{{ $barang->harga }}')"
                                                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-200 dark:border-gray-200 dark:text-dark dark:hover:text-dark dark:hover:bg-gray-200 dark:focus:ring-blue-500 dark:focus:text-white">
                                                    Ambil
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ $barang->no_item }}</td>
                                    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $barang->kode_log }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah }}</td>
                                    <td class="px-6 py-4">{{ $barang->satuan }}</td>
                                    <td class="px-6 py-4">{{ $barang->harga }}</td>
                                    <td class="px-6 py-4">{{ $barang->rak }}</td>
                                    <td class="px-6 py-4">{{ $barang->total }}</td>
                                    <td class="px-6 py-4">{{ $barang->tanggal }}</td>
                                    <td class="px-6 py-4">{{ $barang->jumlah_minimal }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_katalog }}</td>
                                    <td class="px-6 py-4">{{ $barang->merk }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_akun }}</td>
                                    <td class="px-6 py-4">{{ $barang->no_barcode }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex items-center mb-4 border-b pb-4 mt-4">
                    <a href="{{ route('barangs.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Add
                        Barang</a>
                    <!-- Button to trigger modal -->
                    <button data-modal-target="qr-modal" data-modal-toggle="qr-modal"
                        class="ms-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">QR
                        Scan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Entry Modal --}}
    <div id="entry-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-5xl max-h-full">
            <!-- Modal content Entry Exit -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <span id="modal-title">Form Penambahan Barang</span>
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="entry-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('barangs.entry') }}" method="POST">
                    @csrf
                    {{-- Entry Form --}}
                    <input type="hidden" id="barang-id-entry" name="barang_id" value="">
                    <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-2 p-3">
                        <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-2">
                            <div class="form-group">
                                <label for="nama_barangentry"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Barang</label>
                                <input type="text" name="nama_barang" id="nama_barangentry"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_barcodeentry"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">QR ID</label>
                                <input type="text" name="no_barcode" id="no_barcodeentry"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="jumlah"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                    Stok</label>
                                <input type="number" name="jumlah" id="jumlahentry"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="hargalama"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                    Terkini</label>
                                <input type="number" name="hargalama" id="hargalama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="kode_logentry"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                    Gudang</label>
                                <input type="text" name="kode_log" id="kode_logentry"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-2">
                            <div class="form-group">
                                <label for="no_po"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor PO
                                </label>
                                <input type="text" name="no_po" id="no_po"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="harga_beli"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Beli
                                    Barang</label>
                                <input type="text" name="harga" id="harga_beli"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_beli"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                </label>
                                <input type="text" name="jumlah_beli" id="jumlah_beli"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="operator"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Operator
                                </label>
                                <input type="text" name="operator" id="operator"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="mb-3 text-gray-400 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 rounded-lg text-sm px-5 py-2.5 me-2"
                            data-modal-toggle="crud-modal">Cancel</button>
                        <button type="submit"
                            class="mb-3 me-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    {{-- Exit Modal --}}
    <div id="exit-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-5xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <span id="modal-title">Form Pengambilan Barang</span>
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="exit-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <form action="{{ route('barangs.exit') }}" method="POST">
                    @csrf
                    <input type="hidden" id="barang-id-exit" name="barang_id" value="">
                    <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-2 m-4 p-3">
                        <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-2">
                            <div class="form-group">
                                <label for="nama_barang"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_barcode"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">QR ID</label>
                                <input type="text" name="no_barcode" id="no_barcode"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="jumlah"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                    Stok</label>
                                <input type="number" name="jumlah_sekarang" id="jumlah"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="form-group">
                                <label for="kode_log"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                    Gudang</label>
                                <input type="text" name="kode_log" id="kode_log"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required readonly>
                            </div>
                            <div class="col-span-2">
                                <div class="form-group">
                                    <label for="no_bom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                        BOM</label>
                                    <input type="text" name="no_bom" id="no_bom"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="institusi"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Institusi</label>
                                    <input type="text" name="institusi" id="institusi"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2 lg:grid-cols-2">
                            <div class="form-group">
                                <label for="order_number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    Order</label>
                                <select name="order_number" id="order_number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                    <option value="">Select Order Number</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->order_number }}">{{ $order->order_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_item"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                                    Item</label>
                                <select name="no_item" id="no_item"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                    <option value="">Select No Item</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_keluar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                    Ambil</label>
                                <input type="number" name="jumlah_keluar" id="jumlah_keluar"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="satuan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                                <input type="text" name="satuan" id="satuan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    readonly required>
                            </div>
                            <div class="form-group">
                                <label for="operator"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Operator</label>
                                <input type="text" name="operator" id="operator"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="mb-3 text-gray-400 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 rounded-lg text-sm px-5 py-2.5 me-2"
                            data-modal-toggle="exit-modal">Cancel</button>
                        <button type="submit"
                            class="me-3 mb-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- QR Code and Quantity Modal -->
    <div id="qr-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Search & Exit Quantity
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="qr-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body QR Code -->
                <form id="search-form" method="POST" action="{{ route('barangs.search') }}" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4">
                        <div class="col-span-2">
                            <label for="qr_code"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">QR Code</label>
                            <input type="text" name="qr_code" id="qr_code"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="text-gray-400 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 rounded-lg text-sm px-5 py-2.5 me-2"
                            data-modal-toggle="qr-modal">Cancel</button>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-white rounded-lg shadow m-4 dark:bg-dark-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-700 sm:text-center dark:text-gray-700">© 2024 <a href="http://atmi.co.id"
                    class="hover:underline">PT. ATMI SOLO</a>. All Rights Reserved.
            </span>
            @include('clock')
        </div>
    </footer>

    <script>
        function setMaterialentryDetails(id, nama_barang, no_barcode, jumlah, kode_log, harga) {
            // Set the form fields with the passed data
            document.getElementById('barang-id-entry').value = id;
            document.getElementById('nama_barangentry').value = nama_barang;
            document.getElementById('no_barcodeentry').value = no_barcode;
            document.getElementById('jumlahentry').value = jumlah;
            document.getElementById('kode_logentry').value = kode_log;
            document.getElementById('hargalama').value = harga;


            // Open the modal
            console.log('ID:', id);
            const modal = document.getElementById('entry-modal');
            modal.classList.remove('hidden');
            modal.classList.add('block');
        }
    </script>

    <script>
        function setMaterialDetails(id, nama_barang, no_barcode, jumlah, kode_log,satuan) {
            // Set the form fields with the passed data
            document.getElementById('barang-id-exit').value = id;
            document.getElementById('nama_barang').value = nama_barang;
            document.getElementById('no_barcode').value = no_barcode;
            document.getElementById('jumlah').value = jumlah;
            document.getElementById('kode_log').value = kode_log;
            document.getElementById('satuan').value = satuan;


            // Open the modal
            console.log('ID:', id);
            const modal = document.getElementById('exit-modal');
            modal.classList.remove('hidden');
            modal.classList.add('block');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderNumberSelect = document.getElementById('order_number');
            const noItemSelect = document.getElementById('no_item');
            orderNumberSelect.addEventListener('change', function() {
                const orderNumber = this.value;
                if (orderNumber) {
                    fetch(`/get-order-items/${orderNumber}`)
                        .then(response => response.json())
                        .then(data => {
                            noItemSelect.innerHTML = '<option value="">Select No Item</option>';
                            data.forEach(itemadd => {
                                const option = document.createElement('option');
                                option.value = itemadd.no_item;
                                option.textContent = itemadd.no_item;
                                noItemSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>




</x-app-layout>
