<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Bahan Baku</th>
            <th>Qty</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @forelse($data as $bahan_baku)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ App\Model\Menu\BahanBaku::findOrFail($bahan_baku->bahan_baku_id)->nama }}</td>
            <td>{{ $bahan_baku->qty }} {{ App\Model\Menu\BahanBaku::findOrFail($bahan_baku->bahan_baku_id)->satuan->nama }}</td>
            <td>
                <button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                <center>
                    <h3>Tidak ada Data</h3>
                </center>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>