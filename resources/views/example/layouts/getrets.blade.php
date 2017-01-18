<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="favicon.ico">

        <title>GetRETS - @yield('title')</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        @if (!empty(config('getrets.customer_key')))
        @yield('styles')
        @endif

    </head>

    <body>

        @if (!empty(config('getrets.customer_key')))
        @yield('content')
        @else
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger" role="alert">
                    <h1>Customer Key Required!</h1>
                    <p class="lead">
                        You can specify a customer key in your .env file<br />
                        GETRETS_CUSTOMER_KEY=your_key<br /><br />
                        If you do not have a customer key, you can obtain an evaluation key from <a href="http://www.timitek.com/" target="_blank">www.timitek.com</a><br />
                        If you want to see a running instance of this example please visit <a href="http://www.timitek.com/phpsdk/" target="_blank">www.timitek.com/phpsdk/</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    @if (!empty(config('getrets.customer_key')))
    @yield('scripts')
    @endif

</body>
</html>
