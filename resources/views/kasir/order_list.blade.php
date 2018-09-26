<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Menu</th>
            <th>Qty</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $grand_total = 0 @endphp
        @forelse($order_list as $menu)
        <tr>
            <td>{{ $menu->menu->nama }}</td>
            <td>{{ $menu->qty }}</td>
            <td>Rp {{ number_format($menu->subtotal) }}</td>
            <td>
                <button class="btn btn-sm btn-dark" onclick="remove_item({{$menu->order_temp_id}}, {{ $menu->menu->id }})">-</button>    
                <button class="btn btn-sm btn-dark" onclick="add_item({{$menu->order_temp_id}}, {{ $menu->menu->id }})">+</button>    
                <button class="btn btn-sm btn-danger" onclick="delete_item({{$menu->order_temp_id}}, {{ $menu->menu->id }})"><i class="fa fa-trash"></i></button>    
            </td>
        </tr>
        @php $grand_total = $grand_total + $menu->subtotal @endphp
        @empty
        <tr>
            <td colspan="4">
                <center>
                    <h3>Belum ada menu dipilih</h3>
                </center>
            </td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">Total</td>
            <td colspan="2"><strong>Rp {{ number_format($grand_total) }}</strong></td>
        </tr>
    </tfoot>
</table>