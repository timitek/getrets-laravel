<!--================================
imageUrl
================================-->
<hr>
<div id="imageUrl" class="content section">

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">imageUrl</h3></div>
        <div class="panel-body">
            <p>Available for both cached (<a href="https://github.com/timitek/getrets-php-sdk#imageurl" target="_blank">documentation</a>) and RETS (<a href="https://github.com/timitek/getrets-php-sdk#imageurl-1" target="_blank">documentation</a>).</p>
            <blockquote><p>Get details for a specific listing</p></blockquote>
            <p><a href="http://getrets.net/swagger/ui/index#!/Listing/Listing_Image" target="_blank">Swagger Documentation</a></p>
            <pre>GetRETS::getListing()->imageUrl($listingSource, $listingType, $listingId, $photoId, $width = null, $height = null);</pre>
            <p>
                Retrieves an image(s) associated with a specific listing.<br /><br />
                <strong><em>Special Note</em></strong> - While the width and height parameters are optional, using them to specify an appropriate image size will increase the speed in which your site renders by lowering the need to download a full size image.<br /><br />
                Also, fetching the first photo ($photoId = 0) is a suggested strategy for displaying a thumbnail image.
            </p>
        </div>
    </div>

    @if (empty($detail))
    <div class="well well-lg">
        <p class="lead">Perform a search first and then select a listing to see the images.</p>
    </div>

    @else
    <div class="row">
        <!--================================
        Image Carousel
        ================================-->
        <div class="col-xs-12 col-md-6">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @for ($i = 0; $i < $detail->photoCount; $i++)
                    <li data-target="#carousel-example-generic" data-slide-to="0" {{ $i===0 ? 'class="active"' : '' }}></li>
                    @endfor
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @for ($i = 0; $i < $detail->photoCount; $i++)
                    <div class="item{{ $i===0 ? ' active' : '' }}">
                        <img src="{{ GetRETS::getListing()->imageUrl($detail->listingSourceURLSlug, $detail->listingTypeURLSlug, $detail->listingID, $i) }}" class="img-responsive" alt="..." style="width: 100%;">
                        <div class="carousel-caption">
                            Photo {{ $i+1 }}
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!--================================
        Thumbnails
        ================================-->
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Thumbnails</h3></div>
                <div class="panel-body">
                    <div class="row">
                        @for ($i = 0; $i < $detail->photoCount; $i++)
                        @php 
                        $imgSrc = GetRETS::getListing()->imageUrl($detail->listingSourceURLSlug, $detail->listingTypeURLSlug, $detail->listingID, $i)
                        @endphp
                        <div class="col-xs-6">
                            <a href="{{ $imgSrc }}" target="_blank" class="thumbnail">
                                <img src="{{ $imgSrc }}" alt="...">
                            </a>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
