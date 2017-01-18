<!--================================
Details
================================-->
<div class="tab-pane" id="details">

    <div class="row">

        <div class="col-sm-3">
            <div class="list-group">
                <a class="list-group-item" href="#detailsSection">details</a>
                <a class="list-group-item" href="#imageUrl">imageUrl</a>
            </div>
        </div>

        <div class="col-sm-9">
            <h1>Details</h1>
            <p class="lead">
                Listings contain more advanced details / meta data and images.
            <ol>
                <li><a href="#detailsSection">details</a> - <em>(applicable for both <strong>cached</strong> and <strong>RETS</strong>)</em></li>
                <li><a href="#imageUrl">imageUrl</a> - <em>(applicable for both <strong>cached</strong> and <strong>RETS</strong>)</em></li>
            </ol>
            </p>

            @include('GetRETS::example.partials.details.details', $data)

            @include('GetRETS::example.partials.details.imageUrl', $data)

        </div>
    </div>

</div>
