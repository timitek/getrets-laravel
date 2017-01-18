<!--================================
executeDMQL
================================-->
<hr>
<div id="executeDMQL" class="content section">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">executeDMQL</h3></div>
        <div class="panel-body">
            <p>RETS Only (<a href="https://github.com/timitek/getrets-php-sdk#executedmql" target="_blank">documentation</a>).</p>
            <blockquote><p>Return MLS results via a DMQL query</p></blockquote>
            <p><a href="http://getrets.net/swagger/ui/index#!/RETSListing/RETSListing_ExecuteDMQL" target="_blank">Swagger Documentation</a></p>
            <pre>GetRETS::getRETSListing()->executeDMQL($query, $feedName, $listingType);</pre>
            <p>This is a powerful function that will execute raw DMQL against the RETS MLS server and will return the results as a serialized object.</p>
            <p><strong><em>Special Note</em></strong> - These results will not be returned in a translated fashion similiar to the other listing detail searches.  These results are in the format as returned from the MLS RETS server.  If you wish to retrieve listings in a <strong>translated</strong> format use getListingsByDMQL.</p>
        </div>
    </div>

    <div class="well well-lg">
        <form action="/getrets/example#executeDMQL"  method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="dmql">DMQL</label>
                <textarea class="form-control" id="dmql" name="dmql" rows="3" {{ ($isPublic ? 'disabled' : '') }}>{{ $dmql }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="executeDMQL">Execute DMQL (returns raw serialized results)</button>
        </form>

        @if (!empty($rawData))
        <pre>
                  {{ var_dump($rawData) }}
        </pre>
        @endif
    </div>

</div>
