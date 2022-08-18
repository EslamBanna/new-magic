<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, shrink-to-fit=no ">
    <!-- <link rel="icon" type="{{''}}" href="{{url('/images/admin/favicon.png')}}"> -->
    <!--***************styel sheets and bootstrap*******-->
    <link rel="stylesheet" href="{{ url('/css/admin/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/admin/bootstrap.min.css') }}">
    <!--************** Plugins******* -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--*************Internal style sheet****************-->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/admin/admin-mainCSS.css')}}" />
    
       <link rel="stylesheet" href="{{asset('js/admin/jquery-datatables/datatables.css')}}"/>
</head>

<!--start side menue--------------------------------------------------------->
<div id="wrapper">
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
        <div class="brand-logo">
            <img src="{{asset('images/admin/themagic.jpeg')}}"style="width:100px;height:60px;" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">the magic Admin</h5>

        </div>
        <div class="user-details">
            <div class="media align-items-center user-pointer collapsed" data-toggle="collapse"
                data-target="#user-dropdown">
                <div class="avatar"><img class="mr-3 side-user-img" src="{{asset('images/admin/avatar-s-12.jpg')}}"
                        alt="user avatar"></div>
                <div class="media-body">
                    <h6 class="side-user-name">Options<i class="fas fa-angle-left"></i></h6>
                </div>
            </div>
            <div id="user-dropdown" class="collapse">
                <ul class="user-setting-menu">
                    <li><a target="_blank" href="/"><i class="fas fa-cog " ></i> The Magic</a></li>
                    <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class=" nav-item"><a href="{{url('admin/dashboard')}}"><i
                                class="fas fa-chart-line icons"></i><span class="menu-title"
                                data-i18n="">Dashboard</span></a>
                    </li>
                    <li class=" nav-item"><a href="{{route('users.index')}}"><i class="fas fa-users icons"></i><span
                                class="menu-title" data-i18n="">Users</span></a>
                    </li>
                   
                    <li class=" nav-item"><a href="{{route('slider.index')}}"><i class="fas fa-ad icons"></i><span
                                class="menu-title" data-i18n="">Slider</span></a>
                    </li>
                    <li class=" nav-item"><a href="{{route('consultant-packages.index')}}"><i class="fas fa-hand-holding-usd icons"></i><span
                                class="menu-title" data-i18n="">Packages</span></a>
                    </li>


                    <li class=" nav-item"><a href="{{route('organizers.index')}}"><i class="fas fa-users icons"></i><span
                        class="menu-title" data-i18n="">Organizers</span></a>
                    </li>
                    
                      <li class=" nav-item"><a href="{{route('all-consult-tests')}}"><i class="fas fa-star icons"></i><span
                        class="menu-title" data-i18n="">All Consultant Tests</span></a>
                    </li>


                    {{-- <li class=" nav-item"><a href="{{route('admin-messages')}}"><i class="fas fa-users icons"></i><span
                                class="menu-title" data-i18n="">Messages</span></a>
                    </li> --}}
                    {{-- <li class="nav-item"><a href="{{route('support.index')}}"><i
                                class="fas fa-envelope-open-text icons"></i><span class="menu-title"
                                data-i18n="">Support</span></a>
                    </li> --}}

                </ul>
            </div><a href="/logout" class="btn btn-danger btn-block btn-glow btn-log-out mx-1 pull-up"> Log
                Out!</a>

        </div>
    </div>
    <!----------------------------------------------------------------End Side menu-->
    <!--start nav bar header-------------------------------------------------->
    <header class="topbar-nav">
        <nav id="header-setting" class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <div class="nav-control">
                        <div class="hamburger">
                            <span class="line"></span><span class="line"></span><span class="line"></span>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="search-bar" action="">
                        <input type="text" class="form-control typeahead" placeholder="What You Want To Find ?"name="search">
                        <a href="#"><i class="fas fa-search"></i></a>
                    </form>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">
                <li class="nav-item dropdown-lg">
                    <a class="nav-link  waves-effect" href="">

                        <i class="far fa-bell bx-tada"></i><span class="badge badge-primary badge-up "></span></a>
                </li>
                <li><a target="_blank" href="/"><i class="bx bx-cog bx-spin"></i></a></li>

                <li class="nav-item">
                    <a class="nav-link " href="">
                        <span class="user-profile"><img src="{{asset('images/admin/avatar-s-12.jpg')}}"
                                class="img-circle pull-up" alt="user avatar"></span>
                    </a>

                </li>
            </ul>
        </nav>
    </header>
    <!-------------------------------------------------------end nav bar header-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!--***************javascript**********-->
    <script type="text/javascript" src="{{ asset('js/admin/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/bootstrap.bundle.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/bootstrap.min.js')}}"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

  
    
<script src="{{asset('js/admin/jquery-datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/admin/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js')}}"></script>


<script>
   $(document).ready(function(){
       // $('#example tr:last').remove();
        $('#example').DataTable(
            {

                buttons: [

                ],
                'paging': true,
                 "pagingType": "numbers",
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,


            }
        );
    });
    </script>
    
    var path="";
    $('input.typeahead').typeahead({
        source: function(terms,process){
            return $.get(path,{terms:terms},function(data){
                return process(data);
            });

        }

    });
    </script>

    </body>

</html>
