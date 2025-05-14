<div class="row mb-3">
    <form id="searchForm" method="GET" action="{{ route($route) }}">
        <div class="input-group mb-3">
            <input id="searchBox" type="text" name="search" class="form-control-sm" placeholder="{{ $placeholder }}"
                value="{{ request('search') }}" aria-label="Case search box with two button addons">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
            <button type="button" class="btn btn-outline-secondary" id="clearButton">Clear</button>
        </div>
    </form>
</div>
