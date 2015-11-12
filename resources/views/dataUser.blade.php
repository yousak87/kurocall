@extends('layout')
@section('content')


<section class="wrapper">

    <div class="row mt">
        @if(count($errors->all())!=0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
        </div>
        @endif
        <div class="col-lg-12">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> User Data</h4>
                <section id="unseen">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>

                                <th class="numeric">First Name</th>
                                <th class="numeric">Last Name</th>
                                <th class="numeric">Email</th>
                                <th class="numeric">Sex</th>
                                <th class="numeric">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)

                            <tr>
                                <td>{{ $user->f_name }}</td>
                                <td class="numeric">{{ $user->l_name }}</td>
                                <td class="numeric">{{ $user->email }}</td>
                                <td class="numeric">{{ $user->sex==1?'MALE':'FEMALE' }}</td>
                                <td class="numeric">
                                    <a href="{{ action('PagesController@editUser',$user->id) }}" class="btn">Edit</a>
                                    <a href="{{ action('PagesController@deleteUser',$user->id) }}" class="btn">Delete</a>
                                </td>

                            </tr>

                            @endforeach




                        </tbody>
                    </table>
                    {!! $users->render() !!}
                </section>
            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->			
    </div><!-- /row -->




</section><! --/wrapper -->
@stop