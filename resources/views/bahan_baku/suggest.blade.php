<br>
<table class="table table-border custom-table m-b-0">
    {{-- <thead>
        <tr>
            <th style="width: 8%"></th>
            <th style="width: 15%">Nama Menu</th>
            <th style="width: 10%">Harga</th>
            <th style="width: 15%"></th>
        </tr>
    </thead> --}}
    <tbody>
        @forelse($bahan_baku as $list)
        <tr>
            <td><img src="{{ asset($list->foto) }}" alt="" style="width:60px"></td>
            <td>Nama Bahan Baku : <i>{{ $list->nama }}</i> </td>
            <td>
                <div class="input-group">
                    
                    <input type="number" class="form-control" placeholder="Masukan Bahan Baku {{ $list->nama }} yang dibutuhkan" id="bahan_baku-{{ $list->id }}" name="bahan_baku[{{ $list->id }}]" value="{{ old('harga') }}" required>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">{{ $list->satuan->nama }}</span>
                    </div>
                    
                </div>

                {{-- <div class="input-group">
                    <input type="number" name="qty{{ $list->id }}" id="qty{{ $list->id }}" placeholder="Qty" maxlength="3" size="3" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-danger" id="submit" onclick="add_to_order({{ $list->id }})">
                            <span class="fa fa-plus"></span>
                        </button>
                    </span>
                </div> --}}


                    {{-- <input type="text" name="pin">
                <button onclick="add_to_order({{ $list->id }})" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i></button> --}}
            </td>
            <td>
                <button type="submit" class="btn btn-sm btn-danger" onclick="tambah_bahan_baku({{ $list->id }})"><i class="fa fa-plus"></i> Tambah</button>
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