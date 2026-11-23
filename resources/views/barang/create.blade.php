<form action="{{ route('barang.store') }}" method="POST">
    @csrf
    <div>
        <label>Jenis (1 Karakter, misal: B/J)</label>
        <input type="text" name="jenis" maxlength="1" required>
    </div>
    <div>
        <label>Nama Barang</label>
        <input type="text" name="nama" maxlength="45" required>
    </div>
    <div>
        <label>Satuan</label>
        <select name="idsatuan" required>
            @foreach($satuans as $s)
                <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Harga</label>
        <input type="number" name="harga" required>
    </div>
    <div>
        <label>Status</label>
        <select name="status" required>
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>
    </div>
    <button type="submit">Simpan</button>
</form>
