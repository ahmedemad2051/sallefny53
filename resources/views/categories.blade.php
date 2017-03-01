@extends('layouts.app')

@section('header')
    <style>
        .editForm {
            display: inline-block;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="col-md-6">
                        {!! Form::open() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-7">
                                {!! Form::text('name','',['class'=>'form-control','placeholder'=>'category name']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::submit('add',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div>
                        @if(count($categories)>0)
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>name</th>
                                    <th>actions</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr class="cat">
                                        <td>{!! $category->name !!}</td>
                                        <td>
                                            <a class='btn btn-primary edit' id='{!! $category->id !!}'>edit</a>
                                            {!! Form::open(['method'=>'delete','class'=>'editForm','url'=>'categories/'.$category->id]) !!}
                                            {!! Form::submit('delete',['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! $categories->render() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.edit', function () {
            var category_id = $(this).attr('id');
            var category_name = $(this).parent().prev().text();
            $('.editUrl').attr('action', '{!! Request::root() !!}/categories/' + category_id);
            $('.name').val(category_name);
            $('#myModal').modal();
        });

    </script>

    <!-- Modal -->

    <div class="modal fade modal-info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            {!! Form::open(['method'=>'put','class'=>'editUrl']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <label>name</label>
                    <input type='text' class='name form-control form-control-success' name='name' style='color:#000'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
            {!! Form::close() !!}
        </div><!-- /.modal-dialog -->
    </div>


@endsection