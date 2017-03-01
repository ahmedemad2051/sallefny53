@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <div class="">
                            <div class="form-group">
                                <div class="col-md-3">
                                    {!! Form::text('name','',['class'=>'form-control name','placeholder'=>'product name']) !!}

                                    <span class="help-block">
                                        <strong class="name_error text-danger"></strong>
                                    </span>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    {!! Form::number('price','',['class'=>'form-control price','placeholder'=>'product price']) !!}

                                    <span class="help-block">
                                        <strong class="price_error text-danger"></strong>
                                    </span>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <select name='category_id' class='form-control category_id'>
                                        <option value="">Product category</option>
                                        @foreach(Auth()->user()->categories as $category)
                                            <option value='{!! $category->id !!}'>{!! $category->name !!}</option>
                                        @endforeach
                                    </select>

                                        <span class="help-block">
                                        <strong class="category_error text-danger"></strong>
                                    </span>

                                </div>
                            </div>
                            {!! Form::button('add',['class'=>'btn btn-primary add']) !!}
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="ajax">
                            @include('__products')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.add', function () {
            var name = $('.name').val();
            var price = $('.price').val();
            var category_id = $('.category_id').val();

            $.ajax({
                url: '/home/add',
                datatype: 'json',
                type: 'post',
                data: {name: name, price: price, category_id: category_id, _token: '{!! csrf_token() !!}'},
                success: function (data) {
                    $('.ajax').html(data);
                    $('.name').val('');
                    $('.price').val('');
                    $('.category_id').val('');
                },
                error: function (error) {
                    var errors = JSON.parse(error['responseText']);
                    console.log(errors['name'][0]);
                    $('.name_error').html(errors['name'][0]);
                    $('.price_error').html(errors['price'][0]);
                    $('.category_error').html(errors['category_id'][0]);
                }
            });

        });

        $(document).on('click', '.edit', function () {
            var product_id = $(this).attr('id');
            $.get('/home/getProduct', {product_id: product_id}, function (data) {
                $('#myModal').html(data);
                $('#myModal').modal();
            });

        });

        $(document).on('click', '.delete', function () {
            var id = $(this).attr('id');

            swal({
                        title: "Are you sure?",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "yes, delete it.",
                        closeOnConfirm: false
                    },
                    function () {
                        $.get("{!! url('home/delete') !!}", {id: id}, function (data) {
                            $('.ajax').html(data);
                        });
                        swal("Deleted!", "product has been deleted.", "success");
                    });


        });

    </script>


    <!-- Modal -->

    <div class="modal fade modal-info" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    </div>

@endsection
