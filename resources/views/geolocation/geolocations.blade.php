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
            <div class="col-md-4 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="col-md-10">
                        {!! Form::open() !!}

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                {!! Form::label('Address') !!}
                                {!! Form::text('address','',['class'=>'form-control','placeholder'=>'address']) !!}
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                {!! Form::label('Latitude') !!}
                                {!! Form::text('latitude','',['class'=>'form-control','placeholder'=>'latitude']) !!}
                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                {!! Form::label('Longitude') !!}
                                {!! Form::text('longitude','',['class'=>'form-control','placeholder'=>'longitude']) !!}
                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::submit('add',['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    <br>

                </div>

            </div>
            <div class="col-md-10 col-md-offset-1">
                @if(count($geolocations)>0)
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th>Address</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>actions</th>
                        </tr>
                        @foreach($geolocations as $geo)
                            <tr class="cat">
                                <td>{!! $geo->address !!}</td>
                                <td>{!! $geo->latitude !!}</td>
                                <td>{!! $geo->longitude !!}</td>
                                <td>
                                    <a class='btn btn-primary edit' id='{!! $geo->id !!}'>edit</a>
                                    {!! Form::open(['method'=>'delete','class'=>'editForm','url'=>'geolocations/'.$geo->id]) !!}
                                    {!! Form::submit('delete',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $geolocations->render() !!}
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.edit', function () {
            var geo_id = $(this).attr('id');
            var longitude = $(this).parent().prev().text();
            var latitude = $(this).parent().prev().prev().text();
            var address = $(this).parent().prev().prev().prev().text();

            $('.editUrl').attr('action', '{!! Request::root() !!}/geolocations/' + geo_id);
            $('.address').val(address);
            $('.latitude').val(latitude);
            $('.longitude').val(longitude);
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
                    <h4 class="modal-title">Edit Geo location</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-8">
                            <label>address</label>
                            <input type='text' class='address form-control form-control-success' name='address'
                                   style='color:#000'>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <label>latitude</label>
                            <input type='text' class='latitude form-control form-control-success' name='latitude'
                                   style='color:#000'>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <label>longitude</label>
                            <input type='text' class='longitude form-control form-control-success' name='longitude'
                                   style='color:#000'>
                        </div>
                    </div>
                </div>
                <div class="row"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
            {!! Form::close() !!}
        </div><!-- /.modal-dialog -->
    </div>


@endsection