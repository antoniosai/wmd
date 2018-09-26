<table class="table table-border custom-table m-b-0">
    <thead>
        <tr>
            <th style="width: 8%"></th>
            <th style="width: 15%">Nama Menu</th>
            <th style="width: 10%">Harga</th>
            <th style="width: 15%"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($menu as $list)
        <tr>
            <td><img src="{{ asset($list->foto) }}" alt="" style="width:60px"></td>
            <td>{{ $list->nama }} <label for="label label-success">{{ $list->kategori->nama }}</label> </td>
            <td>Rp {{ number_format($list->harga) }}</td>
            <td>
                <div class="input-group">
                    <input type="number" name="qty{{ $list->id }}" id="qty{{ $list->id }}" placeholder="Qty" maxlength="3" size="3" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-danger" id="submit" onclick="add_to_order({{ $list->id }})">
                            <span class="fa fa-plus"></span>
                        </button>
                    </span>
                </div>


                    {{-- <input type="text" name="pin">
                <button onclick="add_to_order({{ $list->id }})" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button> --}}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                <center><h3>Tidak ada Data</h3></center>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>