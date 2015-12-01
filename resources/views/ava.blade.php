@extends('calender')
@section('content')

<div id="mask" ><img id="pic" src="{!! asset('load.gif')!!}"></div>
<div class="row mt">
    <div class="col-lg-12">

        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Available Apps</h4>
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th><i class="fa fa-bullhorn"></i> ID</th>
                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> NAME</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id='mytable'>


                </tbody>
            </table>
        </div>
        <button class="btn btn-primary" onclick="refresh()">Refresh Data</button>

    </div><!-- col-lg-12-->      	
</div><!-- /row -->
<script>
    function refresh() {
        $('#mytable').empty();
        $.ajax({
            dataType: "json",
            url: "{{ action('ApiController@available_apps') }}"
        }).done(function (data) {
            obj = data.data;
            var arr = Object.keys(obj).map(function (key) {
                return obj[key]
            });
            var a = arr.length;
            for (i = 0; i < a; i++) {
                var text;
                if (arr[i]['status'] === 'Subscribed') {
                    text = '<tr><td><a href="">' + arr[i]['id'] + '</a></td><td class="hidden-phone">' + arr[i]['name'] + '</td><td><span class="label label-success label-mini">' + arr[i]['status'] + '</span></td><td><button class="btn btn-primary btn-xs" onclick="plan(' + arr[i]['id'] + ')" data-toggle="modal" data-target="#myModal">Subscibe/Upgrade</button></td></tr>';
                } else {
                    text = '<tr><td><a href="">' + arr[i]['id'] + '</a></td><td class="hidden-phone">' + arr[i]['name'] + '</td><td><span class="label label-info label-mini">' + arr[i]['status'] + '</span></td><td><button class="btn btn-primary btn-xs" onclick="plan(' + arr[i]['id'] + ')" data-toggle="modal" data-target="#myModal">Subscibe/Upgrade</button></td></tr>';
                }
                $('#mytable').append(text);

            }
        }).fail(function () {
            alert("Ajax failed to fetch data");
        });
    }
    refresh();


    function plan(id) {
        var app_id = id;
        $('#tableModal').empty();
        $.ajax({
            dataType: "json",
            url: "/api/plan/" + id
        }).done(function (data) {
            obj = data.data.plans;

            var arr = Object.keys(obj).map(function (key) {
                return obj[key]
            });
            console.info(arr[0].plan);
            var a = arr.length;
            for (i = 0; i < a; i++) {
                var text;

                text = '<tr><td><a href="">' + arr[i]['id'] + '</a></td><td class="hidden-phone">' + arr[i]['plan'] + '</td><td>' + arr[i]['descriptions'] + '</td><td>' + arr[i]['monthly_price'] + '</td><td><button class="btn btn-primary btn-xs">Chose Plan</button></td></tr>';
                $('#head' + i).empty();
                $('#head' + i).append(arr[i]['plan'] + ' only $' + arr[i]['monthly_price']);
                $('#des' + i).empty();
                $('#des' + i).append(arr[i]['descriptions']);


            }
        }).fail(function () {
            alert("Ajax failed to fetch data");
        });

    }


    mask = $('#mask');

    function maskPage() {


        mask.show();
        setTimeout(function () {
            mask.hide();
            $("#myConfirm").modal('show');
        }, 3000);



    }

</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Please Chose Your Plan</h4>
            </div>
            <div class="modal-body" id="modalLine">
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="head0">
                            
                        </div>
                        <div class="panel-body" id="des0">
                            
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary btn-lg btn-block" data-dismiss="modal" onclick="maskPage()" type="button">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-green">
                        <div class="panel-heading" id="head1">
                            
                        </div>
                        <div class="panel-body" id="des1">
                            <p></p>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-success btn-lg btn-block" data-dismiss="modal" onclick="maskPage()" type="button">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-red">
                        <div class="panel-heading" id="head2">
                            
                        </div>
                        <div class="panel-body" id="des2">
                            <p></p>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-danger btn-lg btn-block" data-dismiss="modal" type="button" onclick="maskPage()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Your Plan already Process</h4>
            </div>
            <div class="modal-body" id="modalLine">

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

@stop
