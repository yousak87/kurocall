@extends('calender')
@section('content')

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
<div class="row mt">
    <div class="col-lg-12">

        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Pages Management</h4>
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th> ID</th>
                        <th> Title</th>
                        <th> Content</th>
                        <th> Slug</th>
                        <th> Image</th>
                        <th> Header Image</th>
                        <th> Parent ID</th>
                        <th> Brief</th>
                        <th> Description</th>
                        <th> Keyword</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($pages as $page)

                    <tr>

                        <td class="numeric">{{ $page->id }}</td>
                        <td class="numeric">{{ $page->title }}</td>
                        <td class="numeric" ><a title="{{ $page->content }}">{{ substr($page->content,0,20) }}</a></td>
                        <td class="numeric">{{ $page->slug }}</td>
                        <td class="numeric"><img width="100" height="100" src="{!! asset('upload')!!}/{{ $page->image }}"></td>
                        <td class="numeric"><img width="100" height="100" src="{!! asset('upload')!!}/{{ $page->header_img }}"></td>
                        <td class="numeric">{{ $page->parent_id }}</td>
                        <td class="numeric"><a title="{{ $page->brief }}">{{ substr($page->brief,0,20) }}</a></td>
                        <td class="numeric"><a title="{{ $page->description }}">{{ substr($page->description,0,20) }}</a></td>
                        <td class="numeric">{{ $page->keywords }}</td>





                        <td class="numeric">
                            <a href="{{ action('PagesController@editPages',$page->id) }}" class="btn">Edit</a>
                            <a href="{{ action('PagesController@deletePages',$page->id) }}" class="btn">Delete</a>
                        </td>

                    </tr>

                    @endforeach

                </tbody>
            </table>
            {!! $pages->render() !!}
        </div>
        <a href="/addNewPages"><button class="btn btn-primary">Add New Data</button></a>

    </div><!-- col-lg-12-->      	
</div><!-- /row -->



@stop
