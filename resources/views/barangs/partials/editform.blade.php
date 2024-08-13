<form action="{{ $action }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="no_barcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Barcode ID</label>
            <input type="text" id="no_barcode" name="no_barcode" value="{{ old('no_barcode', $barang->no_barcode ?? $randomBarcode ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly />
        </div>
        <div>
            <label for="no_item" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Item</label>
            <input type="text" id="no_item" name="no_item" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly />
        </div>
        <div>
            <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nama Barang</label>
            <select id="nama_barang" name="nama_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required >
                <option value="">Pilih Nama Barang</option>
                @foreach($barang as $b)
                    <option value="{{ $b->nama_barang }}" data-no-item="{{ $b->no_item }}" data-kode-akun="{{ $b->kd_akun }}" data-kode-log="{{ $b->kode_log }}" data-satuan="{{ $b->satuan }}"
                         data-rak="{{ $b->rak }}" data-harga="{{ $b->harga }}" data-merk="{{ $b->merk }}" data-jumlah-minimal="{{ $b->jumlah_minimal }}"
                         data-no-katalog="{{ $b->no_katalog }}" data-jumlah-maksimal="{{ $b->jumlah_maksimal }}" data-no-reff="{{ $b->no_reff }}">
                        {{ $b->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="kd_akun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Akun</label>
            <input type="text" id="kd_akun" name="kd_akun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $barang->jumlah ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
        </div>
        <div>
            <label for="kode_log" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kode Log</label>
            <input type="text" id="kode_log" name="kode_log" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Harga</label>
            <input type="number" id="harga" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Satuan</label>
            <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $barang->satuan ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Total</label>
            <input type="disabled" id="total" name="total" value="{{ old('total', $barang->total ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
        </div>
        <div>
            <label for="rak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Rak</label>
            <input type="text" id="rak" name="rak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="jumlah_minimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Jumlah Minimal</label>
            <input type="number" id="jumlah_minimal" name="jumlah_minimal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $barang->tanggal ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
        </div>
        <div>
            <label for="jumlah_maksimal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Jumlah Maksimal</label>
            <input type="number" id="jumlah_maksimal" name="jumlah_maksimal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="no_katalog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Katalog</label>
            <input type="text" id="no_katalog" name="no_katalog" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="merk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Merek</label>
            <input type="text" id="merk" name="merk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="no_reff" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">No Refferensi</label>
            <input type="text" id="no_reff" name="no_reff" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required readonly/>
        </div>
        <div>
            <label for="no_akun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Nomor Akun</label>
            <input type="text" id="no_akun" name="no_akun" value="{{ old('no_akun', $barang->no_akun ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-100 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="-" required />
        </div>
    </div>

    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
        {{ $buttonText }}
    </button>
</form>


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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const namaBarangSelect = document.getElementById('nama_barang');
        const noItemInput = document.getElementById('no_item');
        const kodeLogInput = document.getElementById('kode_log');
        const kodeAkunInput = document.getElementById('kd_akun');
        const satuanInput = document.getElementById('satuan');
        const rakInput = document.getElementById('rak');
        const hargaaInput = document.getElementById('harga');
        const merkInput = document.getElementById('merk');
        const jumlahminimalInput = document.getElementById('jumlah_minimal');
        const jumlahmaksimalInput = document.getElementById('jumlah_maksimal');
        const nokatalogInput = document.getElementById('no_katalog');
        const noreffInput = document.getElementById('no_reff');
       

        namaBarangSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            noItemInput.value = selectedOption.getAttribute('data-no-item');
            kodeLogInput.value = selectedOption.getAttribute('data-kode-log');
            kodeAkunInput.value = selectedOption.getAttribute('data-kode-akun');
            satuanInput.value = selectedOption.getAttribute('data-satuan');
            rakInput.value = selectedOption.getAttribute('data-rak');
            hargaaInput.value = selectedOption.getAttribute('data-harga');
            merkInput.value = selectedOption.getAttribute('data-merk');
            jumlahminimalInput.value = selectedOption.getAttribute('data-jumlah-minimal');
            jumlahmaksimalInput.value = selectedOption.getAttribute('data-jumlah-maksimal');
            nokatalogInput.value = selectedOption.getAttribute('data-no-katalog');
            noreffInput.value = selectedOption.getAttribute('data-no-reff');
        });

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
