

<!-- title-->
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($product->title) ? $product->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<!--end title -->

<!-- desc -->

<div class="form-group {{ $errors->has('desc') ? 'has-error' : ''}}">
    <label for="desc" class="control-label">{{ 'Desc' }}</label>
    <textarea class="form-control" rows="5" name="desc" type="textarea" id="summary-ckeditor" >{{ isset($product->desc) ? $product->desc : ''}}</textarea>
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>
<!-- end desc -->

<!-- price -->

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="price" type="number" id="price" value="{{ isset($product->price) ? $product->price : ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>

<!--end price -->

<!-- category -->

<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="control-label">{{ 'Category' }}</label>
    <select class="form-control" name="category"  id="category" >
    <option value="0" selected>--select category--</option>
    @if(isset($subcategory))
    <option value="{{ $subcategory->Category->id }}" selected>{{ $subcategory->Category->name }}</option>
        @foreach ($categories->where('id','!=',$subcategory->Category->id) as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    @else
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    @endif
</select>
</div>
<!-- end category -->

<!-- subcategory -->

<div class="form-group {{ $errors->has('subcategory') ? 'has-error' : ''}}">
    <label for="subcategory" class="control-label">{{ 'Subcategory' }}</label>
    <select name="subcategory_id" class="form-control" id="subcategory_id" >

    @if(isset($subcategory))
      <option value="{{ $subcategory->id }}" selected>{{ $subcategory->name }}</option>
        @foreach ($subcategories->where('id','!=',$subcategory->id) as $subcategory)
        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
        @endforeach
    @else
    <option value="0" selected>--select subcategory--</option>
    @endif
</select>
    {!! $errors->first('subcategory', '<p class="help-block">:message</p>') !!}
</div>
<!-- end subcategory -->

<!-- img -->
<div class="form-group {{ $errors->has('img') ? 'has-error' : ''}}">
    <label for="img" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="img" type="file" id="img" value="{{ isset($product->img) ? $product->img : ''}}" >
    {!! $errors->first('img', '<p class="help-block">:message</p>') !!}
</div>
<!-- end img -->


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>
<script>

        $('#category').on('change', function(e){
            console.log(e);

            var cat_id = e.target.value;

            $.get('/ajax-subcat?cat_id=' + cat_id, function(data) {

               $('#subcategory_id').empty();
               $('#subcategory_id').append('<option value="0" selected>--select subcategory--</option>');
       
               $.each(data, function(index, subcatObj){
                    $('#subcategory_id').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');

               });

            });

        });


</script>
