<!DOCTYPE html>
<html>

<head>
    <title>Admin|add-Slider-Image</title>
    <!--*************Internal style sheet****************-->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/admin/admin-add-product.css')}}" />
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
    <!--start side menue--------------------------------------------------------->
    @include("admin.layouts.sidenav")

    <!--------------------------------------end side menu-->

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
                                <a class="nav-link active" href="{{route("slider.index")}}"><i
                                        class="fas fa-layer-group"></i></i>All Images</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route("slider.create")}}"><i
                                        class="fas fa-plus-circle"></i> Add
                                    New Image</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>

            <!--start add image------------------------------------------------------------>
            <div class="container-fluid animatedParent animateOnce my-3" style="padding:50px">
                <div class="animated fadeInUpShort go" >
                    <form id="needs-validation" action="{{route("slider.update",$slider)}}" novalidate method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="row">
                                <div class="row">
                                <div class="form-group">
                                    <label for="inputGroupFile01">choose Slider image</label>
                                    <div class="form-group">
                                        <input type="file" name="image" id="slider-img" value="{{$slider['image_path']}}" >
                                    </div>
                                    <div class="header-logo" style="margin-bottom: 30px">
                                    {{-- <img src="" id="profile-img-tag" style="height: 100px; width: 300px;" /> --}}
                                    </div>
                                </div>
                               
                                <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function() {
                                //     $(document).ready(function(){
                                // $('#slider-img').on('change', function() {
                                //         $("#slider-img").src="images/user/magic2.png";
                                    
                                //             });
                                //             });
                            
                                    // "use strict";
                                    // window.addEventListener("load", function() {
                                    //     var form = document.getElementById("needs-validation");
                                    //     form.addEventListener("submit", function(event) {
                                    //         if (form.checkValidity() == false) {
                                    //             event.preventDefault();
                                    //             event.stopPropagation();
                                    //         }
                                    //         form.classList.add("was-validated");
                                    //         var editorElement = document.getElementById(
                                    //             "productDescription");
                                    //         if (editorElement.value == '') {
                                    //             editorElement.parentNode.classList.add(
                                    //                 "is-invalid");
                                    //             editorElement.parentNode.classList.remove(
                                    //                 "is-valid");
                                    //         } else {
                                    //             editorElement.parentNode.classList.remove(
                                    //                 "is-invalid");
                                    //             editorElement.parentNode.classList.add("is-valid");
                                    //         }

                                    //     }, false);
                                    // }, false);
                                }());
                                </script>
                            </div>

                        </div>
                        <div class=" bg-transparent">
                            <button class="btn btn-primary pull-up" type="submit">Publish</button>
                        </div>

                    </form>
                </div>
                
            </div>
            <!---------------------------------------------------------------------end add image -->

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