@extends('calender')
@section('content')

<script type="text/javascript" src="{!! asset('js/nicEdit.js')!!}"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
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

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Pages Data
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" method="post" enctype="multipart/form-data" action="/addNewPages"> 
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title">

                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label>Content</label>
                            <textarea rows="10" class="form-control" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input class="form-control" type="text" name="slug">

                        </div>


                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label>Upload Header Image</label>
                            <input type="file" name="header">
                        </div>
                        <div class="form-group">
                            <label>Brief</label>
                            <textarea rows="3" class="form-control" name="brief"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="3" class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Keyword</label>
                            <input class="form-control" type="text" name="keyword">

                        </div>
                        <div class="form-group">
                            <label>Parent ID</label>
                            <input class="form-control" type="text" name="parent_id">

                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </form>
                </div>

            </div>
            <!-- /.row (nested) -->
        </div>
        <!-- /.panel-body -->
    </div>        
</section><! --/wrapper -->
@stop