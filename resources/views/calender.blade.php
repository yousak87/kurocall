<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>Kurocellu</title>
        <script src="{!! asset('js/jquery.js')!!}"></script>
        <script src="{!! asset('js/jquery-ui-1.9.2.custom.min.js')!!}"></script>
        <!-- Bootstrap core CSS -->
        <link href="{!! asset('css/bootstrap.css')!!}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{!! asset('js/gritter/css/jquery.gritter.css') !!}" />
        <link rel="stylesheet" type="text/css" href="{!! asset('css/sb-admin-2.css') !!}" />
        <!--external css-->
        <link href="{!! asset('font-awesome/css/font-awesome.css')!!}" rel="stylesheet" />
        <link href="{!! asset('js/fullcalendar/bootstrap-fullcalendar.css')!!}" rel="stylesheet" />
        <script type="text/javascript" src="{!! asset('js/gritter/js/jquery.gritter.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/gritter-conf.js') !!}"></script>

        <!-- Custom styles for this template -->
        <link href="{!! asset('css/style.css')!!}" rel="stylesheet">
        <link href="{!! asset('css/style-responsive.css')!!}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <section id="container" >
            <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
            <!--header start-->
            <header class="header black-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <!--logo start-->
                <a href="/home" class="logo"><b>Kurocellu</b></a>
                <!--logo end-->

                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li><a class="logout" href="{{ action('PagesController@logout') }}">Logout</a></li>
                    </ul>
                </div>
            </header>
            <!--header end-->

            <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">

                        <p class="centered"><a href="/home"><img src="{!! asset('img/ui-sam.jpg') !!}" class="img-circle" width="60"></a></p>
                        <h5 class="centered">{{Session::get("name")}}</h5>

                        <li class="mt">
                            <a  href="{{ action('PagesController@home') }}">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <?php
                        if (Session::get('level') == 1) {
                            ?>
                            <li class="sub-menu">
                                <a href="/addAdmin">
                                    <i class="fa fa-bars"></i>
                                    <span>Add Admin</span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="/addPages">
                                    <i class="fa fa-envelope-o"></i>
                                    <span>Pages Management</span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (Session::get('level') == 3) {
                            ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-desktop"></i>
                                    <span>Apps</span>
                                </a>
                                <ul class="sub">

                                    <li><a  href="/sub">subscriptions</a></li>
                                    <li><a  href="/ava">available apps</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-envelope"></i>
                                    <span>Usage Report</span>
                                </a>
                                <ul class="sub" id="listApp">

                                    <li><a  href="/sub">subscriptions</a></li>
                                    <li><a  href="/ava">available apps</a></li>
                                </ul>
                            </li>

                            <li class="sub-menu">
                                <a href="/bill">
                                    <i class="fa fa-bars"></i>
                                    <span>Billing Info</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">

                    <!-- page start-->
                    @yield('content')

                    <!-- page end-->

                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2014 - Alvarez.is
                    <a href="/home" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>
        <script>
        function listApp() {

        $('#listApp').empty();
                $.ajax({
                dataType: "json",
                        url: "{{ action('ApiController@subscriptions') }}"
                }).done(function (data) {
        obj = data.data;
                var arr = Object.keys(obj).map(function (key) {
        return obj[key]
        });
                var a = arr.length;
                for (i = 0; i < a; i++) {

        $('#listApp').append('<li><a  href="/usage/' + arr[i]['id'] + '">' + arr[i]['name'] + '</a></li>');
        }
        }).fail(function () {
        alert("Ajax failed to fetch data");
        });
        }
listApp();
        function greting(){
        var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: '{{Session::get("name")}}!',
                // (string | mandatory) the text inside the notification
                text: 'Welcome to KuroCall.',
                // (string | optional) the image to display on the left
                image: '{!! asset("img/ui-sam.jpg") !!}',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: true,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'my-sticky-class'
        });
                return false;
        }
<?php
if (Session::get('greting') == "1") {
    ?>
    greting();
    <?php
}
Session::put('greting', "0");
?>
        </script>
        <!-- js placed at the end of the document so the pages load faster -->

        <script src="{!! asset('js/fullcalendar/fullcalendar.min.js')!!}"></script>    
        <script src="{!! asset('js/bootstrap.min.js')!!}"></script>
        <script class="include" type="text/javascript" src="{!! asset('js/jquery.dcjqaccordion.2.7.js')!!}"></script>
        <script src="{!! asset('js/jquery.scrollTo.min.js')!!}"></script>
        <script src="{!! asset('js/jquery.nicescroll.js')!!}" type="text/javascript"></script>


        <!--common script for all pages-->
        <script src="{!! asset('js/common-scripts.js')!!}"></script>

        <!--script for this page-->
        <script src="{!! asset('assets/js/calendar-conf-events.js')!!}"></script>    



    </body>
</html>
