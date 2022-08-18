<!DOCTYPE html>
<html>

<head>

    <title>Admin|Contact</title>

    <!--*************Internal style sheet****************-->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/admin/admin-support.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ url('/css/admin/contactus.css') }}">

</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
    <!--start side menue--------------------------------------------------------->
    @include("admin.layouts.sidenav")

    <!----------------------------------------------------------------End Side menu-->


    <!--start main-contenet---------------------------------------------------------->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!--start users support------------------------------------------------------------->
            <div class="col-lg-12">
                
                
        @if(Session::has('error'))
            <div class="alert alert-danger">

                {{Session::get('error')}}

            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success">

                {{Session::get('success')}}

            </div>
        @endif


                <div class="card no-b my-3 shadow2">
                    <div class="card-header white p-3 d-flex justify-content-between ">
                        <h4>Admin Support</h4>
                    </div>
                    <div class="card-body p-0">
                        
                          
                        <div class="table-responsive">
                            <section id="contact-us" class="contact-us section">
                                <div class="container">
                                    <div class="contact-head">
                                        <div class="row">
                                            <div class="col-lg-8 col-12">
                                                <div class="form-main">
                                                    <div class="title">
                                                        <h4>Get in touch</h4>
                                                        <h3>Write us a message</h3>
                                                    </div>
                                                    <form id="contactform" action="{{route('admin.contact.submit')}}" method="POST">
                                                        {{csrf_field()}}
                                                        <div class="row">
                                                            <div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Your Name<span>*</span></label>
                                                                    <input required name="name" type="text" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Your Subjects<span>*</span></label>
                                                                    <input name="subject" required type="text" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Your Email<span>*</span></label>
                                                                    <input required name="email" type="email" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Admin Email you want to contact<span>*</span></label>
                                                                    @if (isset($organizer))
                                                                    <input name="admin_email" type="email" placeholder="" value="{{$organizer['email']}}">
                                                                    @else
                                                                    <input name="admin_email" type="email" required placeholder="" value="">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label>your message<span>*</span></label>
                                                                <div class="form-group message">
                                                                    <textarea required name="message" placeholder=""></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group button">
                                                                    <button type="submit" class="btn " style="background-color: #f7941d">Send Message</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="single-head">
                                                    <div class="single-info">
                                                        <i class="fa fa-phone"></i>
                                                        <h4 class="title">Call us Now:</h4>
                                                        <ul>
                                                            <li>+966 59 553 3931</li>
                        
                                                        </ul>
                                                    </div>
                                                    <div class="single-info">
                                                        <i class="fa fa-envelope-open"></i>
                                                        <h4 class="title">Email:</h4>
                                                        <ul>
                                                            <li><a href="">magicthestyle@gmail.com</a></li>
                                                        </ul>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--/ End Contact -->
                              
                        </div>
                    </div>
                </div>
            </div>

            <!-------------------------------------------------------------------------end user support-->
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