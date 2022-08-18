<div class="header-logo" style="margin-bottom: 30px">
    <img src="{{asset('images/user/magic2.png')}}" style="height: 100px; width: 300px;" />
</div>

<div class="magic-nav" style="margin-bottom: 30px">
    <nav class="navbar navbar-expand-md navbar-light " style="background-color: #FFF;">
        <a class="navbar-brand  logo Script-font" style="color: #D69784" >The Magic</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">


            <ul dir="rtl" class="navbar-nav  mx-auto" >
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('/ar')}}">الرئيسية <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('aboutUs')}}">تفاصيل عنا</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('blog')}}">مدونة</a>
                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{route('user-profile')}}">الملف الشخصي</a>
                </li>

                <li class="nav-item">
                    <a class="pointer" href="{{route('login')}}"  style="color: #D69784;">
                        <img src="https://img.icons8.com/ios-glyphs/30/D69784/add-user-male.png"/>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="pointer"  hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                        <img src="https://img.icons8.com/ios-glyphs/28/D69784/google-translate.png"/>
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</div>
