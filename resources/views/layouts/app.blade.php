@include('layouts.header')

@if(\App::getLocale() == 'en')

     @include('layouts.nav')
@else
    @include('layouts.nav_ar')
@endif


@yield('content')



@include('layouts.footer')
