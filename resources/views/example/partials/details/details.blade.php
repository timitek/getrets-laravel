<!--================================
details
================================-->
<hr>
<div id="detailsSection" class="content section">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">details</h3></div>
        <div class="panel-body">
            <p>Available for both cached (<a href="https://github.com/timitek/getrets-php-sdk#details" target="_blank">documentation</a>) and RETS (<a href="https://github.com/timitek/getrets-php-sdk#details-1" target="_blank">documentation</a>).</p>
            <blockquote><p>Get details for a specific listing</p></blockquote>
            <p><a href="http://getrets.net/swagger/ui/index#!/Listing/Listing_GetListingDetails" target="_blank">Swagger Documentation</a></p>
            <pre>GetRETS::getListing()->details($listingSource, $listingType, $listingId);</pre>
            <p>Retrieves the more specific / non condensed details for a listing. You will typically use the values returned from search functions as the parameters.</p>
        </div>
    </div>

    @if (empty($detail))
    <div class="well well-lg">
        <p class="lead">Perform a search first and then select a listing to see the details.</p>
    </div>

    @else
    <ul class="nav nav-tabs">
        <li role="presentation" class="active" id="detailsNavMain"><a href="javascript:void(0);">Results</a></li>
        <li role="presentation" id="detailsNavData"><a href="javascript:void(0);">Data</a></li>
    </ul>

    <div id="detailsMain">

        <h1>{{ $detail->address }}<br /><small>{{ $detail->listPrice }}</small></h1>
        <div class="row">

            <!--================================
            Detail Summary
            ================================-->
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-xs-6"><small class="pull-left"><strong>Provided By:</strong> {{ $detail->providedBy }}</small></div>
                    <div class="col-xs-6"><small class="pull-right"><strong>Listing ID:</strong> {{ $detail->listingID }}</small></div>
                    <div class="col-xs-12">
                        <hr />
                        <p>{{ $detail->description }}</p>
                        <div class="getrets-features">
                            <ul>
                                <li><strong>Type:</strong> {{ $detail->listingTypeURLSlug }}</li>
                                <li><strong>Price:</strong> {{ $detail->listPrice }}</li>
                                <li><strong>Beds:</strong> {{ $detail->beds }}</li>
                                <li><strong>Baths:</strong> {{ $detail->baths }}</li>
                                <li><strong><abbr title="Square Feet">Sqft.</abbr>:</strong> {{ $detail->squareFeet }}</li>
                                <li><strong>Lot:</strong> {{ $detail->lot }}</li>
                                <li><strong>Acres:</strong> {{ $detail->acres }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <!--================================
            Features
            ================================-->
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Features</h3></div>
                    <div class="panel-body">
                        <div class="getrets-features">
                            <ul>
                                @foreach($detail->features as $feature)
                                <li><strong>{{ $feature }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div id="detailsData" style="display: none;">
        <pre>
                  {{ var_dump($detail) }}
        </pre>
    </div>
    @endif

</div>
