<!-- START BLOG SIDEBAR (Bootstrap 5 Structure) -->

<!-- 1. Search Widget -->

<div class="card mb-4">
<div class="card-body">
<form class="d-flex" action="#">
<!-- Using BS5 form-control and a button for the icon -->
<input type="text" placeholder="Search..." class="form-control" name="search" aria-label="Search blog posts">
<button class="btn btn-outline-secondary ms-2" type="submit" aria-label="Search">
<!-- Assuming Font Awesome is loaded. If not, replace with a Bootstrap Icon (bi-search) -->
<i class="fa fa-search"></i>
</button>
</form>
</div>
</div>
<!-- End Search Widget -->

<!-- 2. Categories Widget -->

<div class="card mb-4">
<!-- Replaced widget-title with card-header and custom separator with standard BS5 classes -->
<h5 class="card-header fw-bold text-uppercase">Categories</h5>

<!-- widget-body replaced by list-group (inside or outside card-body is flexible) -->
<ul class="list-group list-group-flush">
    @foreach($categories as $category)
    <!-- Use list-group-item and d-flex for spacing between name and count -->
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="{{ route('blog.categorywise', str_replace(" ", "-", $category->name)) }}" class="text-decoration-none text-dark">
            {{ $category->name }}
        </a>
        <span class="badge bg-primary rounded-pill">{{ $category->blogs->count() }}</span>
    </li>
    @endforeach
</ul>


</div>
<!-- End Categories Widget -->

<hr class="my-4"/>

<!-- 3. Popular Posts Widget -->

<div class="card mb-4">
<h5 class="card-header fw-bold text-uppercase">Popular Posts</h5>

<div class="card-body p-3">
    <!-- Replaced widget-posts with list-unstyled for custom popular posts layout -->
    <ul class="list-unstyled">
        @foreach($populars as $popular)
        <!-- Use d-flex (clearfix replacement) to align image and text -->
        <li class="d-flex align-items-start mb-3 border-bottom pb-3">
            
            <!-- Image Wrapper with margin-end (me-3) -->
            <a href="{{ route('blog.single', $popular->slug) }}" class="flex-shrink-0 me-3">
                @if($popular->featured_image != null)
                <!-- Added img-fluid and a fixed size (w-25) for better control -->
                <img src="{{ asset('images/blogs/'.$popular->featured_image) }}" alt="{{ $popular->title }}" class="img-fluid rounded w-25" onerror="this.onerror=null; this.src='{{ asset('images/600x315.png') }}';" />
                @else
                <img src="{{ asset('images/600x315.png') }}" alt="Placeholder image" class="img-fluid rounded w-25" />
                @endif
            </a>
            
            <!-- Text Content Wrapper -->
            <div class="flex-grow-1 min-w-0">
                <!-- Title: fw-bold for bold, text-truncate for overflow ellipsis -->
                <a href="{{ route('blog.single', $popular->slug) }}" class="d-block text-truncate text-dark fw-bold mb-1" style="max-width: 100%;">
                    {{ $popular->title }}
                </a>
                <!-- Small text: d-block for full line, text-muted for color -->
                <small class="d-block text-muted text-truncate">
                    {{ $popular->user->name }} - {{ date('F d', strtotime($popular->created_at)) }}
                </small>
            </div>
        </li>
        @endforeach
    </ul>
</div>


</div>
<!-- End Popular Posts Widget -->

<hr class="my-4"/>

<!-- 4. Archive Widget -->

<div class="card mb-4">
<h5 class="card-header fw-bold text-uppercase">Archive</h5>

<ul class="list-group list-group-flush">
    @foreach($archives as $archive)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="{{ route('blog.monthwise', date('Y-m', strtotime($archive->created_at))) }}" class="text-decoration-none text-dark">
            {{ date('F Y', strtotime($archive->created_at)) }}
        </a>
        <span class="badge bg-primary rounded-pill">{{ $archive->total }}</span>
    </li>
    @endforeach
</ul>


</div>
<!-- End Archive Widget -->

<!-- END BLOG SIDEBAR -->