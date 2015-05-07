@if (Auth::user()->userType == 1 && Auth::user()->userStatus == 1)
    @section('leftSideMenu')
        <li>
            <a href="/dashboard" @if (Route::getCurrentRoute()->getPath() == 'dashboard') class="active" @endif><i class="fa dashboard-icon fa-fw"></i>&nbsp;&nbsp;Dashboard</a>
        </li>
        <li>
            <a href="/feeding/draining" @if (Route::getCurrentRoute()->getPath() == 'feeding/draining') class="active" @endif><i class="fa question-icon fa-fw"></i>&nbsp;&nbsp;Feed & Drain</a>
        </li>
        <li>
            <a href="/weight/heat" @if (Route::getCurrentRoute()->getPath() == 'weight/heat') class="active" @endif><i class="fa lesson-icon fa-fw"></i>&nbsp;&nbsp;Weight & Heat</a>
        </li>
        <li>
            <a href="/place/play" @if (Route::getCurrentRoute()->getPath() == 'place/play') class="active" @endif><i class="fa lesson-icon fa-fw"></i>&nbsp;&nbsp;Place & Play</a>
        </li>
        <li>
            <a href="/shop/store" @if (Route::getCurrentRoute()->getPath() == 'shop/store') class="active" @endif><i class="fa lesson-icon fa-fw"></i>&nbsp;&nbsp;Shop & Store</a>
        </li>
        <li>
            <a href="/social/mama" @if (Route::getCurrentRoute()->getPath() == 'social/mama') class="active" @endif><i class="fa lesson-icon fa-fw"></i>&nbsp;&nbsp;Social Mama</a>
        </li>
        <li>
            <a href="/good/living" @if (Route::getCurrentRoute()->getPath() == 'good/living') class="active" @endif><i class="fa lesson-icon fa-fw"></i>&nbsp;&nbsp;Good Living</a>
        </li>
    @stop
@endif

