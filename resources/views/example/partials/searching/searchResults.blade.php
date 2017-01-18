
<!--================================
searchResults
================================-->
<hr>
<div id="searchResults" class="content section">
    <h3>Search Results</h3>
    <ul class="nav nav-tabs">
        <li role="presentation" class="active" id="searchResultsNavMain"><a href="javascript:void(0);">Results</a></li>
        <li role="presentation" id="searchResultsNavData"><a href="javascript:void(0);">Data</a></li>
    </ul>

    <div id="searchResultsMain">

        <!--================================
        Sorting
        ================================-->
        <div class="row">
            <div class="col-xs-12">
                @if (empty($listings))
                <div class="well well-sm text-center">
                    <h3><strong>No</strong> Results</h3>
                </div>
                @else
                <br />
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3 class="panel-title">setSortBy / setReverseSort</h3></div>
                    <div class="panel-body">
                        <blockquote><p>Used for sorting / ordering the results that are returned</p></blockquote>
                        <p><a href="https://github.com/timitek/getrets-php-sdk#setsortby--setreversesort" target="_blank">Documentation</a></p>
                        <pre>GetRETS::getListing()->setSortBy("providedBy")->setReverseSort(true)->searchByKeyword($preparedKeywords);</pre>
                    </div>
                </div>

                <div class="well well-lg">
                    <form action="/getrets/example#searchResults"  method="post" class="form-inline">
                        {{ csrf_field() }}
                        
                        @foreach (array_diff_key($allInput, array('reverseSort' => null, 'sortBy' => null, '_token' => null)) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                        @endforeach

                        <div class="form-group">
                            <p class="form-control-static"><strong>Sort By:</strong></p>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="sortBy">
                                @foreach ($listings[0] as $key => $value)
                                <option{!! $key === $sortBy ? ' selected="true"' : '' !!}>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <p class="form-control-static"><strong>Reverse Sort:</strong></p>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="reverseSort" value="true" {{ ($reverseSort ? 'checked' : '') }} />
                        </div>

                        <button type="submit" class="btn btn-primary" name="applySort">Apply Sort</button>
                    </form>
                </div>
                @endif

            </div>
        </div>

        <!--================================
        Listings
        ================================-->
        @if(!empty($listings))
        <div class="row">
            @foreach ($listings as $listing)
            <div class="col-xs-12 col-md-6">
                <div class="thumbnail" style="min-height: 450px;">
                    <img src="{{ ($disableCache ? 
                         GetRETS::getRETSListing()->imageUrl($listing->listingSourceURLSlug, $listing->listingTypeURLSlug, $listing->listingID, 0) : 
                         GetRETS::getListing()->imageUrl($listing->listingSourceURLSlug, $listing->listingTypeURLSlug, $listing->listingID, 0)) . '?newWidth=242&maxHeight=200' }}" alt="...">
                    <div class="caption">
                        <small><strong>Provided By:</strong> {{ $listing->providedBy }}</small><br />
                        <h3>{{ $listing->address }}</h3>
                        <div class="getrets-features">
                            <ul>
                                <li><strong>Type:</strong>{{ $listing->listingTypeURLSlug }}</li>
                                <li><strong>Price:</strong>{{ $listing->listPrice }}</li>
                                <li><strong>Beds:</strong>{{ $listing->beds }}</li>
                                <li><strong>Baths:</strong>{{ $listing->baths }}</li>
                                <li><strong><abbr title="Square Feet">Sqft.</abbr>:</strong>{{ $listing->squareFeet }}</li>
                                <li><strong>Lot:</strong>{{ $listing->lot }}</li>
                                <li><strong>Acres:</strong>{{ $listing->acres }}</li>
                            </ul>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" role="button"
                               href="?{{ http_build_query(['source'=>$listing->listingSourceURLSlug,'type'=>$listing->listingTypeURLSlug,'id'=>$listing->listingID], null, '&', PHP_QUERY_RFC3986) }}{{ $disableCache ? '&disableCache=1' : '' }}#details">
                                Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div id="searchResultsData" style="display: none;">
        <pre>
                  {{ var_dump($listings) }}
        </pre>
    </div>            
</div>
