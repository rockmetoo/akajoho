@if (Auth::user()->userType == 1 && Auth::user()->userStatus == 1)
    @section('leftSideMenu')
        <li>
            <a href="/dashboard" @if (Route::getCurrentRoute()->getPath() == 'dashboard') class="active" @endif><i class="fa dashboard-icon fa-fw"></i>&nbsp;&nbsp;Dashboard</a>
        </li>
        <li>
            <a href="/feeding/draining" @if (Route::getCurrentRoute()->getPath() == 'feeding/draining') class="active" @endif><i class="fa feeding-draining-icon fa-fw-custom"></i>&nbsp;&nbsp;Feed & Drain</a>
        </li>
        <li>
            <a href="/weight/heat" @if (Route::getCurrentRoute()->getPath() == 'weight/heat') class="active" @endif><i class="fa weight-heat-icon fa-fw-custom"></i>&nbsp;&nbsp;Weight & Heat</a>
        </li>
        <li>
            <a href="/place/play" @if (Route::getCurrentRoute()->getPath() == 'place/play') class="active" @endif><i class="fa place-play-icon fa-fw-custom"></i>&nbsp;&nbsp;Place & Play</a>
        </li>
        <li>
            <a href="/shop/store" @if (Route::getCurrentRoute()->getPath() == 'shop/store') class="active" @endif><i class="fa shop-store-icon fa-fw-custom"></i>&nbsp;&nbsp;Shop & Store</a>
        </li>
        <li>
            <a href="/social" @if (Route::getCurrentRoute()->getPath() == 'social') class="active" @endif><i class="fa friendly-mama-icon fa-fw-custom"></i>&nbsp;&nbsp;Social</a>
        </li>
    @stop
@endif

