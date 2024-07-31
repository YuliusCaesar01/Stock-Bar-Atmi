<div class="container mx-auto p-4">
    <form>
        <!-- Upper section -->
        <div class="grid grid-cols-6 gap-4 mb-4">
            <div class="col-span-2">
                <label for="barcode_id" class="block mb-2 text-sm font-medium text-gray-900">Barcode ID</label>
                <input type="text" id="barcode_id" name="barcode_id" value="{{ old('barcode_id', $barang->barcode_id ?? $randomBarcode ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-2">
                <label for="no_item" class="block mb-2 text-sm font-medium text-gray-900">Nomor Item</label>
                <input type="text" id="no_item" name="no_item" value="{{ old('no_item', $barang->no_item ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-2">
                <label for="kode_log" class="block mb-2 text-sm font-medium text-gray-900">Kode Gudang</label>
                <input type="text" id="kode_log" name="kode_log" value="{{ old('kode_log', $barang->kode_log ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-3">
                <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-3">
                <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $barang->jumlah ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
        </div>
        {{-- Middle Section --}}
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="col-span-2">
                <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900">No. BOM</label>
                <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $barang->satuan ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-3">
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Institusi</label>
                <input type="text" id="harga" name="harga" value="{{ old('harga', $barang->harga ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-3">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">Pilih No.Order</label>
                <input type="text" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
            <div class="col-span-2">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">No.Order WP</label>
                <input type="text" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
            <div class="col-span-2">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">UK</label>
                <input type="number" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
            <div class="col-span-2">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">Pilih Nama Item (WP)</label>
                <input type="number" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
            <div class="col-span-2">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">No Item (WP)</label>
                <input type="number" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
            <div class="col-span-2">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">Nama Item (WP)</label>
                <input type="number" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
            <div class="col-span-2">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900">No Item (WP)</label>
                <input type="number" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" readonly />
            </div>
        </div>

        <!-- Lower section -->
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="col-span-4">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $barang->tanggal ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="col-span-4">
                <label for="jumlah_minimal" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                <input type="number" id="jumlah_minimal" name="jumlah_minimal" value="{{ old('jumlah_minimal', $barang->jumlah_minimal ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="col-span-2">
                <label for="no_katalog" class="block mb-2 text-sm font-medium text-gray-900">-</label>
                <input type="text" id="no_katalog" name="no_katalog" value="{{ old('no_katalog', $barang->no_katalog ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
            <div class="col-span-5">
                <label for="merk" class="block mb-2 text-sm font-medium text-gray-900">Diambil Oleh</label>
                <input type="text" id="merk" name="merk" value="{{ old('merk', $barang->merk ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="-" required />
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const jumlahInput = document.getElementById('jumlah');
        const hargaInput = document.getElementById('harga');
        const totalInput = document.getElementById('total');

        function calculateTotal() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            totalInput.value = jumlah * harga;
        }

        jumlahInput.addEventListener('input', calculateTotal);
        hargaInput.addEventListener('input', calculateTotal);

        // Initial calculation in case there are pre-existing values
        calculateTotal();
    });
</script>
