<div class="modal-dialog">
    {!! Form::model($product,['url'=>'/home/edit/'.$product_id]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
            <label>name</label>
            {!! Form::text('name',null,['class'=>'form-control']) !!}
            <label>price</label>
            {!! Form::number('price',null,['class'=>'form-control']) !!}
            <label>category</label>
            {!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline">Save changes</button>
        </div>
    </div><!-- /.modal-content -->
    {!! Form::close() !!}
</div><!-- /.modal-dialog -->