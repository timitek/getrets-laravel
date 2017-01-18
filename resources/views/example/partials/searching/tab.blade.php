<!--================================
Searching - Menu Option
================================-->
<div class="tab-pane" id="searching">
    <div class="row">

        <div class="col-sm-3">
            <div class="list-group">
                <a class="list-group-item" href="#searchByKeyword">searchByKeyword</a>
                <a class="list-group-item" href="#search">search</a>
                <a class="list-group-item" href="#getListingsByDMQL">getListingsByDMQL</a>
                <a class="list-group-item" href="#executeDMQL">executeDMQL</a>
                <a class="list-group-item" href="#searchResults">Search Results</a>
            </div>
        </div>

        <div class="col-sm-9">
            <h1>Searching</h1>
            <p class="lead">
                There are 4 ways to search for listings.
            <ol>
                <li><a href="#searchByKeyword">searchByKeyword</a> - <em>(applicable for both <strong>cached</strong> and <strong>RETS</strong>)</em></li>
                <li><a href="#search">search</a> - <em>(applicable for both <strong>cached</strong> and <strong>RETS</strong>)</em></li>
                <li><a href="#getListingsByDMQL">getListingsByDMQL</a> - <em>(<strong>RETS</strong> Only)</em></li>
                <li><a href="#executeDMQL">executeDMQL</a> - <em>(<strong>RETS</strong> only)</em></li>
            </ol>
            </p>

            @include('GetRETS::example.partials.searching.searchByKeyword', $data)

            @include('GetRETS::example.partials.searching.search', $data)

            @include('GetRETS::example.partials.searching.getListingsByDMQL', $data)

            @include('GetRETS::example.partials.searching.executeDMQL', $data)

            @include('GetRETS::example.partials.searching.searchResults', $data)

        </div>
    </div>
</div>
