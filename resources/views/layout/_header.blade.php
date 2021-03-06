<header class="header d-flex" style="z-index: 1">
    @include("layout._logo")
    <div
        class="d-none flex-md-grow-1 d-md-block bg-white navigation-container__wrapper h-100"
        style="
        box-shadow: 0 0px 5px rgba(0,0,0,0.2);
        z-index:1;"
    >
        <div class="container">
            @include("layout.navigation._navigation")
        </div>
    </div>
</header>
@isset ($breadcrumbs)
<nav aria-label="breadcrumb" class="container my-1 mt-md-5 px-0">
  <ol class="breadcrumb" style="background-color: #f2f5f8 !important;">
      @foreach ($breadcrumbs as $breadcrumb)
          @if (! $loop->last)
              <li class="breadcrumb-item">
                  <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['text'] }}</a>
              </li>
          @else
              <li class="breadcrumb-item active" aria-current="page">
                  {{ $breadcrumb['text'] }}
              </li>
          @endif
      @endforeach
  </ol>
</nav>
@endisset

