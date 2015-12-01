@extends('calender')
@section('content')
<script src="{!! asset('js/Chart.js') !!}"></script>
<div class="row mt">
    <div class="col-lg-12">

        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Usage Line Chart</h4>
            <div class="form-group">

                Usage chart for &nbsp;<label class="control-label" id="app_id"></label></td>

            </div>
            <canvas id="canvas" height="300" width="900"></canvas>       
        </div>
    </div><!-- col-lg-12-->      	
</div><!-- /row -->

<script>
    $(document).ready(function () {
        $("#app_id").change(function () {
            var app_id = $("#type").val("");
            refresh(app_id);
            listApp(app_id);
        });
    });
    var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    function refresh(app_id) {

        var canvas = $('#canvas')[0]; // or document.getElementById('canvas');
        canvas.width = canvas.width;
        var dataChart = [];
        if (app_id === "0") {
            app_id = "1";
        }
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        $.ajax({
            dataType: "json",
            url: "/api/usage/" + app_id
        }).done(function (data) {
            obj = data.data;
            var arr = Object.keys(obj).map(function (key) {
                return obj[key];
            });
            var a = arr.length;


            for (i = 0; i < a; i++) {
                var bulan = monthNames[(new Date(arr[i].date)).getMonth()];
                if (bulan in dataChart) {
                    dataChart[bulan] = dataChart[bulan] + arr[i].total;
                } else {
                    dataChart[bulan] = arr[i].total;
                }

            }
            b = Object.keys(dataChart).length;
            var mydata = [];
            console.info(b);
            for (i = 0; i < monthNames.length; i++) {
                if (typeof dataChart[monthNames[i]] !== 'undefined') {
                    mydata[i] = dataChart[monthNames[i]];
                } else {
                    mydata[i] = null;
                }
            }
            console.info(mydata);
            var data = {
                labels: ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"],
                datasets: [
                    {
                        label: "My Usage",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: mydata
                    },
                ]
            };
            window.onload = function () {
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myLine = new Chart(ctx).Line(data, {
                    responsive: true
                });
            }

        }).fail(function () {
            alert("Ajax failed to fetch data");
        });

    }


    function listApp(app_id) {
        if (app_id === "0") {
            app_id = "1"
        }
        $('#app_id').empty();
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
                if (arr[i]['id'] === app_id) {
                    $('#app_id').append(arr[i]['name']);
                }
            }
        }).fail(function () {
            alert("Ajax failed to fetch data");
        });
    }
    listApp(<?= $datas['app_id'] ?>);
    refresh(<?= $datas['app_id'] ?>);


</script>
@stop
