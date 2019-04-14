<div class="container">

<div class="row">

  <div class="col-lg-3">

    <h1 class="my-4">Shop Name</h1>
    <div class="list-group">

@foreach($categories as $category)
    <div class="btn-group dropright">
        <button type="button" class="btn btn-secondary">
     <a href="/category/{{$category->id}}"> {{$category->name}} </a>
        </button>

        @if(count($category->subcategories)>0)
        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropright</span>
        </button>

      
        <div class="dropdown-menu">
              @foreach($category->subcategories as $subcategory)
              <a class="dropdown-item" href="/subcatgory/{{$subcategory->id}}">{{$subcategory->name}}</a>
              @endforeach
          <!--   <a class="dropdown-item" href="#"><input type="text"/></a> -->
        </div>
        @endif

      </div>    
@endforeach
    </div>

  </div>