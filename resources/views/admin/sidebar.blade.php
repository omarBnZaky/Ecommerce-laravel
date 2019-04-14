<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/dashbord') }}">
                        Dashboard
                    </a>
                </li> 
            </ul>
            <ul class="nav" role="tablist">
            <li role="presentation">
                    <a href="{{ url('/admin/categories') }}">
                         Categories
                    </a>
                </li>
            </ul>

            <ul class="nav" role="tablist">
            <li role="presentation">
                    <a href="{{ url('/admin/subcategories') }}">
                        Sub categories
                    </a>
                </li>
            </ul>
        
            <ul class="nav" role="tablist">
            <li role="presentation">
                    <a href="{{ url('/admin/products') }}">
                        Products
                    </a>
                </li>
            </ul>


            <ul class="nav" role="tablist">
            <li role="presentation">
                    <a href="{{ url('/admin/ads') }}">
                        Ads
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
