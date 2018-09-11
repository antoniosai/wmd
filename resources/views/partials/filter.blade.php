<h2>Pencarian Umum</h2>
<hr>
<div class="col-xs-12">
    <form action="{!! route('search') !!}" class="navbar-form" role="search" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="query" style="width:100%" id="srch-term" required>
            <div class="input-group-btn">
                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </form>
</div>

<h2>Filter Buku</h2>
<hr>
<form action="{!! route('filter.buku') !!}" method="GET">
    <div class="form-group">
        <label for="">Nama Perujuk</label>
        <select name="perujuk_id" class="form-control">
            <option value="all">-- Semua Perujuk --</option>
            @foreach(App\User::all() as $perujuk)
            <option value="{!! $perujuk->id !!}">{!! $perujuk->name !!}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Kategori</label>
        <select name="category_id" class="form-control">
            <option value="all">-- Semua Kategori --</option>
            @foreach(App\Category::all() as $category)
            <option value="{!! $category->id !!}">{!! $category->name !!}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-lg fa-search"></i> Filter Buku</button>
</form>