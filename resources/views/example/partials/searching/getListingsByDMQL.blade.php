<!--================================
getListingsByDMQL
================================-->
<hr>
<div id="getListingsByDMQL" class="content section">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">getListingsByDMQL</h3></div>
        <div class="panel-body">
            <p>RETS Only (<a href="https://github.com/timitek/getrets-php-sdk#getlistingsbydmql" target="_blank">documentation</a>).</p>
            <blockquote><p>Get translated listings by DMQL query</p></blockquote>
            <p><a href="http://getrets.net/swagger/ui/index#!/RETSListing/RETSListing_GetListingsByDMQL" target="_blank">Swagger Documentation</a></p>
            <pre>GetRETS::getRETSListing()->getListingsByDMQL($query, $feedName, $listingType);</pre>
            <p>This is a powerful function that will execute raw DMQL against the RETS MLS server and will return the results as a serialized object.  It is similar to executeDMQL, however this function will <strong>translate</strong> data to be in the same format as returned by other methods that retrieve listing details.</p>
        </div>
    </div>

    <div class="well well-lg">
        <form action="/getrets/example#searchResults"  method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="dmql">DMQL</label>
                <textarea class="form-control" id="dmql" name="dmql" rows="3" {{ $isPublic ? 'disabled' : '' }}>{{ $dmql }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="getListingsByDMQL">Get Listings By DMQL</button>
        </form>
    </div>

</div>
