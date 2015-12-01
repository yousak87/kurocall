@extends('calender')
@section('content')

<div class="row mt">
    <div class="col-lg-12">

        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Billing Record</h4>
            <table class="table table-striped table-advance table-hover">

                <thead>
                    <tr>
                        <th><i class="fa fa-bullhorn"></i> ID</th>
                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Name</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th><i class=" fa fa-windows"></i> Attachment</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody id='mytable'>


                </tbody>
            </table>
            <button class="btn btn-success">Next Due : <span id="next_due"></span></button>
            <button class="btn btn-danger">Owe : <span id="owe"></span></button>
           <button class="btn btn-warning">Credits : <span id="credits"></span></button>

             </div>
                    <button class="btn btn-primary" onclick="refresh()">Refresh Data</button>

    </div><!-- col-lg-12-->      	
</div><!-- /row -->




<script>
    function refresh() {
        $('#mytable').empty();
        $('#next_due').empty();
        $('#owe').empty();
        $('#credits').empty();
        $.ajax({
            dataType: "json",
            url: "{{ action('ApiController@billing') }}"
        }).done(function (data) {
            obj = data.data.invoices;
            console.info(obj);
            var arr = Object.keys(obj).map(function (key) {
                return obj[key];
            });
            $('#next_due').append(data.data.next_due);
            $('#owe').append(data.data.owe);
            $('#credits').append(data.data.credits);

            var a = arr.length;
            for (i = 0; i < a; i++) {
                var text;
                if (arr[i]['status'] === 'paid') {
                    text = '<tr><td><a href="">' + arr[i]['id'] + '</a></td><td class="hidden-phone">' + arr[i]['name'] + '</td><td><span class="label label-success label-mini">' + arr[i]['status'] + '</span></td><td><a href="">' + arr[i]['attachment'] + '</a></td></tr>';
                } else {
                    text = '<tr><td><a href="">' + arr[i]['id'] + '</a></td><td class="hidden-phone">' + arr[i]['name'] + '</td><td><span class="label label-success label-info">' + arr[i]['status'] + '</span></td><td><a href="">' + arr[i]['attachment'] + '</a></td></tr>';
                }
                $('#mytable').append(text);

            }
        }).fail(function () {
            alert("Ajax failed to fetch data");
        });
    }
    refresh();

</script>

@stop
