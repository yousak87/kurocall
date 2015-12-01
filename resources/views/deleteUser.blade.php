@extends('calender')
@section('content')


<section class="wrapper">
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Are you Sure Delete User <?=$users[0]->email?>?</h4>
                <form class="form-inline" role="form" method="post" action="{{ action('DeleteController@deleteUser')}}">
                    <input type="hidden" name="id" value="<?=$users[0]->id?>">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="{{ action('PagesController@home')}}" class="btn btn-warning">Cancel</a>
                </form>
                
            </div><!-- /form-panel -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->
</section><! --/wrapper -->
@stop