<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($subcategory->name) ? $subcategory->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="control-label">{{ 'Category' }}</label>
    <select name="category_id" class="form-control" id="category" >
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
    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
