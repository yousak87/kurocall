@extends('layout')
@section('content')


<section class="wrapper">
    @if(count($errors->all())!=0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <b>Error</b> {{ $error }}<br>
            @endforeach
        </div>
        @endif
    <form class="form-login" method="post" action="{{ action('EditController@editUser')}}">
                    <h2 class="form-signup-heading">Edit User Data</h2>
                    <div class="login-wrap">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <input type="hidden" name="id" value="{{ $users[0]->id }}">

                        <input value="{{ $users[0]->name}}" name="Name" type="text" class="form-control" placeholder="Name" autofocus>
                        <br>
                        <input value="{{ $users[0]->email}}" name="Email" type="text" class="form-control" placeholder="Email" >
                        <h4 class="mb">Sex</h4>
                        <div class="radio">
                            <label>
                                <input type="radio" name="Sex" id="sex" value="1" {{ $users[0]->sex==1?'checked':''}}>
                                Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="Sex" id="sex" value="2" {{ $users[0]->sex==2?'checked':''}}>
                                Female
                            </label>
                        </div>

                        
                        <button class="btn btn-theme02 btn-block" type="submit"><i class="fa fa-lock"></i> Save Data</button>

                    </div>
                </form>	  
</section><! --/wrapper -->
@stop