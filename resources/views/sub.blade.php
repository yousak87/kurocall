@extends('calender')
@section('content')

<div class="row mt">
    <div class="col-lg-12">

        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Subscriptions Apps</h4>
            <table id='mytable' class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>


                                <th class="numeric">ID</th>
                                <th class="numeric">NAME</th>
                                <th class="numeric">STATUS</th>
                                <th class="numeric"></th>

                            </tr>
                        </thead>
                        <tbody id="last">
                        </tbody>
                    </table>
       
             </div>
                    <button class="btn btn-primary" onclick="refresh()">Refresh Data</button>

    </div><!-- col-lg-12-->      	
</div><!-- /row -->




    <script>
        function refresh() {
            $('#last').empty();
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

                    $('#last').append('<tr><td>' + arr[i]['id'] + '</td><td>' + arr[i]['name'] + '</td><td>' + arr[i]['status'] + '</td><td><a href="/usage/' + arr[i]['id'] + '">View Usage Report</a></td></tr>');

                }
            }).fail(function () {
                alert("Ajax failed to fetch data");
            });
        }
        refresh();
    </script>

@stop