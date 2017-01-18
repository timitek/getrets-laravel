
<!--================================
searchByKeyword
================================-->
<hr>
<div id="searchByKeyword" class="content section">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">searchByKeyword</h3></div>
        <div class="panel-body">
            <p>Available for both cached (<a href="https://github.com/timitek/getrets-php-sdk#searchbykeyword" target="_blank">documentation</a>) and RETS (<a href="https://github.com/timitek/getrets-php-sdk#searchbykeyword-1" target="_blank">documentation</a>).</p>
            <blockquote><p>Search for listings by keyword</p></blockquote>
            <p><a href="http://getrets.net/swagger/ui/index#!/Listing/Listing_SearchByKeyword" target="_blank">Swagger Documentation</a></p>
            <pre>GetRETS::getListing()->searchByKeyword($preparedKeywords);</pre>
            <p>A simple search that will retrieve listings by a keyword search.</p>
        </div>
    </div>

    <div class="well well-lg">
        <form action="/getrets/example#searchResults"  method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="keywords">Keywords</label>
                <input class="form-control" id="keywords" name="keywords" placeholder="Enter keywords (address, listing id, etc..)" value="{{ $keywords }}">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="disableCache" value="true" {{ ($disableCache ? 'checked' : '') }} /> 
                    Use non cached direct RETS Data
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="searchByKeyword">Search</button>
        </form>
    </div>

</div>
