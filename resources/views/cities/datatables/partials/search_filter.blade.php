<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Custom Filter</h3>
    </div>
    <div class="panel-body">
        <form method="POST" id="search-form" class="form-inline" role="form">
            {{--<div class="form-group">--}}
                {{--<label for="search_fips">Fips</label>--}}
                {{--<input type="text" class="form-control" name="search_fips" id="search_fips" placeholder="search fips">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="search_name">Name</label>
                <input type="text" class="form-control" name="search_name" id="search_name" placeholder="city name">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>