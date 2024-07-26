<div class="grid gap-6 mb-6 md:grid-cols-2">
    <div>
        <label for="no_barcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Barcode ID</label>
        <input type="text" id="no_barcode" name="no_barcode" value="{{ old('no_barcode', $barang->no_barcode ?? $randomBarcode ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="no_item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Item</label>
        <input type="text" id="no_item" name="no_item" value="{{ old('no_item', $barang->no_item ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-900 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>    <div>
        <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>    
    <div>
        <label for="kode_log" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Log</label>
        <input type="text" id="kode_log" name="kode_log" value="{{ old('kode_log', $barang->kode_log ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $barang->jumlah ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Satuan</label>
        <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $barang->satuan ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Harga</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $barang->harga ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="rak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Rak</label>
        <input type="text" id="rak" name="rak" value="{{ old('rak', $barang->rak ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Total</label>
        <input type="disabled" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $barang->tanggal ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="jumlah_minimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Jumlah Minimal</label>
        <input type="number" id="jumlah_minimal" name="jumlah_minimal" value="{{ old('jumlah_minimal', $barang->jumlah_minimal ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="no_katalog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Katalog</label>
        <input type="text" id="no_katalog" name="no_katalog" value="{{ old('no_katalog', $barang->no_katalog ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="merk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Merek</label>
        <input type="text" id="merk" name="merk" value="{{ old('merk', $barang->merk ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
    <div>
        <label for="no_akun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Akun</label>
        <input type="text" id="no_akun" name="no_akun" value="{{ old('no_akun', $barang->no_akun ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
    </div>
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
