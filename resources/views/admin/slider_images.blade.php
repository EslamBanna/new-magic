<!DOCTYPE html>
<html>

<head>

    <title>Admin|Slider Images</title>

    <!--*************Internal style sheet****************-->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/admin/admin-slider.css')}}" />


</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
    <!--start side menue--------------------------------------------------------->
    @include("admin.layouts.sidenav")

    <!----------------------------------------------------------------End Side menu-->

    <!--start main-contenet---------------------------------------------------------->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!--start products nav------------------------------------------------------------->
            <header class=" accent-3 relative mt-3">
                <div class="container-fluid ">
                    <div class="row p-t-b-10 ">
                        <div class="col">
                            <h4>
                                <i class="fas fa-image"></i>
                                Slider Images
                            </h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <ul class="nav responsive-tab nav-material nav-material-white">
                            <li>
                                <a class="nav-link active" href="{{route('slider.index')}}"><i
                                        class="fas fa-layer-group"></i></i>All Slider Images</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('slider.create')}}"><i
                                        class="fas fa-plus-circle"></i> Add New Image</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>

            <div class="container-fluid animatedParent animateOnce my-3">
                <div class="animated fadeInUpShort go">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card no-b shadow">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table  class="table align-items-center table-flush table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th style="margin-left:50px"> 
                                                        image
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th>
                                                       Added By
                                                    </th>
                                                    <th>
                                                        &nbsp &nbsp created_at
                                                    </th>
                                                    <th>
                                                        &nbsp Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($slider_images as $image)
                                                <tr class="no-b">
                                                    <td>
                                                    </td>
                                                    <td class="w-10 ">
                                                        <img src="{{$image['image_path']}}" alt="">
                                                    </td>
                                                    <td>
                                                    </td>
                                
                                                    <td>{{$image["addedBy_name"]}}</td>
                                                    <td>{{$image["created_at"]}}</td>
                                                    <td>
                                                        <a class="edit"style="text-decoration:none;" href="{{route('slider.edit',$image)}}">
                                                        <!-- <i class="fas fa-pencil-alt  btn-outline-info"></i> -->
                                                        <button type="submit" class="btn btn-sm btn-outline-info round"><i class="fas fa-pencil-alt"></i></button>

                                                        </a>
                                                        <form class="btn btn-fab-sm "
                                                            action="{{route('slider.destroy',$image)}}"
                                                            method="Post">
                                                            @csrf
                                                            @method("delete")
                                                            <!-- <button type="submit"
                                                                class="far fa-trash-alt  btn-outline-danger"></button> -->
                                                                <button type="submit" class="btn btn-sm btn-outline-danger round"><i class="far fa-trash-alt"></i></button>

                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------------------------------------------------------end products details-->

        </div>

    </div>
    <!-------------------------------------------------------------------------end main-contenet-->
    <!--start footer------------------------------------------------------------------------------>
    @include("admin.layouts.footer")

    <!--------------------------------------------------------------------------------end footer-->
    </div>

    <!-----------------------------------------------------------end of main main page wrapper----------------------------------------->

</body>

</html>