
<!--================================
search
================================-->
<hr>
<div id="search" class="content section">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">search</h3></div>
        <div class="panel-body">
            <p>Available for both cached (<a href="https://github.com/timitek/getrets-php-sdk#search" target="_blank">documentation</a>) and RETS (<a href="https://github.com/timitek/getrets-php-sdk#search-1" target="_blank">documentation</a>).</p>
            <blockquote><p>Advanced search</p></blockquote>
            <p><a href="http://getrets.net/swagger/ui/index#!/Listing/Listing_Search" target="_blank">Swagger Documentation</a></p>
            <pre>GetRETS::getListing()->search($keywords, $extra, $maxPrice, $minPrice, $beds, $baths, $includeResidential, $includeLand, $includeCommercial);</pre>
            <p>A more advanced search that retrieves listings constrained by the optional parameters.</p>
        </div>
    </div>

    <div class="well well-lg">
        <form action="/getrets/example#searchResults"  method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="keywords">Keywords</label>
                <input class="form-control" id="keywords" name="keywords" placeholder="Enter keywords (address, listing id, etc..)" value="{{ $keywords }}">
            </div>
            <div class="form-group">
                <label for="extra">Extra</label>
                <input class="form-control" id="extra" name="extra" placeholder="Enter comma seperated list of extra terms to search for (golf, lake, etc..)" value="{{ $extra }}">
            </div>
            <div class="form-group">
                <label for="maxPrice">Max Price</label>
                <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Max Price" value="{{ $maxPrice }}">
            </div>
            <div class="form-group">
                <label for="minPrice">Min Price</label>
                <input type="number" class="form-control" id="minPrice" name="minPrice" placeholder="Min Price" value="{{ $minPrice }}">
            </div>
            <div class="form-group">
                <label for="beds">Beds</label>
                <input type="number" class="form-control" id="beds" name="beds" placeholder="Beds" value="{{ $beds }}">
            </div>
            <div class="form-group">
                <label for="baths">Baths</label>
                <input type="number" class="form-control" id="baths" name="baths" placeholder="Baths" value="{{ $baths }}">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="includeResidential" value="true" {{ ($includeResidential ? 'checked' : '') }} /> 
                    Include Residential
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="includeLand" value="true" {{ ($includeLand ? 'checked' : '') }} /> 
                    Include Land
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="includeCommercial" value="true" {{ ($includeCommercial ? 'checked' : '') }} /> 
                    Include Commercial
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="disableCache" value="true" {{ ($disableCache ? 'checked' : '') }} /> 
                    Use non cached direct RETS Data
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="search">Search</button>
        </form>
    </div>

</div>
