
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>DASHGUM - Bootstrap Admin Template</title>

        <!-- Bootstrap core CSS -->
        <link href="{!! asset('css/bootstrap.css') !!}" rel="stylesheet">
        <!--external css-->
        <link href="{!! asset('font-awesome/css/font-awesome.css') !!}" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
        <link href="{!! asset('css/style-responsive.css') !!}" css/style-responsive.cssrel="stylesheet">

              <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
              <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
              <![endif]-->
    </head>

    <body>

        <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
        @if(count($errors->all())!=0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <b>Error</b> {{ $error }}<br>
            @endforeach
        </div>
        @endif
        <div id="login-page">
            <div class="container">

                <form class="form-login" method="post" action="/signup">
                    <h2 class="form-signup-heading">sign Up</h2>
                    <div class="login-wrap">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input name="Name" type="text" class="form-control" placeholder="Name" autofocus>
                        <br>
                        <input name="Email" type="text" class="form-control" placeholder="Email" >
                        <br>
                        <input name="Password" type="password" class="form-control" placeholder="Password" >
                        <br>
                        <input name="RetypePassword" type="password" class="form-control" placeholder="Retype Password">
                        <h4 class="mb">Sex</h4>
                        <div class="radio">
                            <label>
                                <input type="radio" name="Sex" id="sex" value="1" checked>
                                Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="Sex" id="sex" value="2">
                                Female
                            </label>
                        </div>

                        <label class="checkbox">
                            <span class="pull-right">
                                <a data-toggle="modal" href="/auth/login"> Already Registered?</a>

                            </span>
                        </label>
                        <button class="btn btn-theme02 btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN UP</button>
                        <hr>




                    </div>

                    

                </form>	  	

            </div>
        </div>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{!! asset('js/jquery.js') !!}"></script>
        <script src="{!! asset('js/bootstrap.min.js') !!}"></script>

        <!--BACKSTRETCH-->
        <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
        <script type="text/javascript" src="{!! asset('js/jquery.backstretch.min.js') !!}"></script>
        <script>
        $.backstretch("{!! asset('img/login-bg.jpg') !!}", {speed: 500});
        </script>


    </body>
</html>
