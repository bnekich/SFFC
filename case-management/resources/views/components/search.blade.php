        <div class="w-1/2">
            <form id="searchForm" method="GET" action="{{ $route }}">
                <input id="searchBox" type="text" name="search" class="sffc-text-input mb-2"
                    placeholder="{{ $placeholder }}" value="{{ request('search') }}"
                    aria-label="Case search box with two button addons">
                <button type="submit" class="sffc-btn-primary">Search</button>
                <button type="button" class="sffc-btn-cancel" id="clearButton">Clear</button>
            </form>
        </div>
