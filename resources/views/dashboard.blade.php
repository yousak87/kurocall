@extends('calender')
@section('content')

<script src="{!! asset('js/Chart.js') !!}"></script>
<div class="col-lg-9 main-chart">
    
    <div class="row mt">
        <div class="col-md-5ths col-xs-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div id="in" class="huge"></div><br>
                            <div>Inbound</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-5ths col-xs-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div id="out" class="huge"></div><br>
                            <div>Outbound</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-5ths col-xs-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div id="asw" class="huge"></div><br>
                            <div>Answered</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-5ths col-xs-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div id="hang" class="huge"></div><br>
                            <div>Hangups</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-5ths col-xs-6">
            <div class="panel panel-purple">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bullhorn fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div id="idle" class="huge"></div><br>
                            <div>Idle</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt" id="daily">
        <div class="col-lg-12">

            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Line Chart Daily Activity</h4>
                <canvas id="canvas" height="300" width="900"></canvas>
                <button class="btn btn-primary">Blue Line is Outbound chart</button>
                <button class="btn btn-success">Green Line is inbound chart</button>
                <button class="btn btn-danger">Red Line is Aswered chart</button>

            </div>
        </div><!-- col-lg-12-->      	
    </div><!-- /row -->

</div>
<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>History</h3>
    <div id="content"></div>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            dataType: "json",
            url: "/api/activity/" + $("#app").val()
        }).done(function (data) {


            refresh(data.data);

            history(data.data.history);

            summary(data.data.summary);


        }).fail(function () {
            alert("Ajax failed to fetch data");
        });



    });
    function refresh(obj) {
        var canvas = $('#canvas')[0]; // or document.getElementById('canvas');
        canvas.width = canvas.width;
        var dataChart = [];


        var arr = Object.keys(obj).map(function (key) {
            return obj[key];
        });
        var inbound = obj.daily.inbound;
        var outbound = obj.daily.outbound;
        var answered = obj.daily.answered;



        arrInDate = [];
        arrInVal = [];
        arrOutVal = [];
        arrAnstVal = [];

        for (i = 0; i < inbound.length; i++) {
            if (inbound[i].date !== "") {
                arrInDate[i] = inbound[i].date;
            } else {
                arrInDate[i] = 0;
            }
            if (inbound[i].total !== "") {
                arrInVal[i] = inbound[i].total;
            } else {
                arrInVal[i] = 0;
            }
            if (outbound[i].total !== "") {
                arrOutVal[i] = outbound[i].total;
            } else {
                arrOutVal[i] = 0;
            }
            if (answered[i].total !== "") {
                arrAnstVal[i] = answered[i].total;
            } else {
                arrAnstVal[i] = 0;
            }


        }
        console.info(arrInDate);
        var data = {
            labels: arrInDate,
            datasets: [
                {
                    label: "Inbound",
                    fillColor: "rgba(100,100,100,0.2)",
                    strokeColor: "green",
                    pointColor: "green",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "green",
                    data: arrInVal
                },
                {
                    label: "OutBound",
                    fillColor: "rgba(200,200,205,0.2)",
                    strokeColor: "blue",
                    pointColor: "blue",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "blue",
                    pointHighlightStroke: "blue",
                    data: arrOutVal
                },
                {
                    label: "Answered",
                    fillColor: "rgba(150,150,150,0.2)",
                    strokeColor: "red",
                    pointColor: "red",
                    pointStrokeColor: "red",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "red",
                    data: arrAnstVal
                }
            ]
        };
        setTimeout(function(){
        
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx).Line(data, {
                responsive: true
            });
        
        }, 2000);
    }

    function history(obj) {

        $('#mytable').empty();
        var arr = Object.keys(obj).map(function (key) {
            return obj[key];
        });

        var a = obj.length;
        for (i = 0; i < a; i++) {
            var text;
text = '<div class="desc"><div class="thumb"><span class="badge bg-theme"><i class="fa fa-clock-o"></i></span></div><div class="details"><p><muted>' + arr[i]['date'] + '</muted><br/>' + arr[i]['message'] + '<br/></p></div></div>';
           

            $('#content').append(text);

        }
    }



    function summary(obj) {
        $('#mytableSum').empty();
        $('#in').empty();
        $('#out').empty();
        $('#asw').empty();
        $('#hang').empty();
        $('#idle').empty();
        
        $('#in').append(obj.Inbound);
        $('#out').append(obj.Outbound);
        $('#asw').append(obj.Answered);
        $('#hang').append(obj.Hangup);
        $('#idle').append(obj.Idle);
    }

</script>


<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->
<script src="assets/js/morris-conf.js"></script>
@stop
