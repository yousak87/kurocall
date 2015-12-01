@extends('calender')
@section('content')


<section class="wrapper">
  @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form class="form-login" method="post" action="/addAdmin">
                    <h2 class="form-signup-heading">ADD ADMIN</h2>
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

                        
                        <button class="btn btn-theme02 btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SAVE</button>
                        <hr>




                    </div>

                    

                </form>	  	  
</section><! --/wrapper -->
@stop