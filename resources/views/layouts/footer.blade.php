<!-- Footer -->
<div class="row" style="margin-left : .1%;">
    <footer class="site-footer col-12" style=" margin-left: 0px;  ">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-4 mx-auto">

                    <!-- Content -->

                    <img src="{{asset('images/user/magic2.png')}}" style="height: 100px; width: 200px;" />

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">
                <div class="col-md-4 mx-auto">



                </div>
                <!-- Grid column -->
                <div class="col-md-4 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4 Script-font" style="color: #944c33;">Contact</h5>
                    <h6><img src="https://img.icons8.com/ios-glyphs/20/944c33/message-read.png"/>magicthestyle@gmail.com</h6>


                </div>
                <!-- Grid column -->





            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <hr>
        <!--

                        <ul class="list-unstyled list-inline text-center py-2">
                            <li class="list-inline-item">
                            <h5 class="mb-1">Register for free</h5>
                            </li>
                            <li class="list-inline-item">
                            <a href="#!" class="btn btn-danger btn-rounded" style="color:white; background-color:#60a3bc ;border :#60a3bc;">Sign up!</a>
                            </li>
                        </ul>
                        <hr>
        -->
        <div class="row mx-auto" style="text-align: center">
            <ul class="list-unstyled list-inline text-center mx-auto" >
                <li class="list-inline-item">
                    <a class="btn-floating btn-fb mx-1" target="_blank" href="https://www.facebook.com/The-Magic-Style-100845998800937/">
                        <img src="https://img.icons8.com/ios-glyphs/30/944c33/facebook.png"/>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-tw mx-1" target="_blank" href="https://wa.me/966595533931">
                        <img src="https://img.icons8.com/ios-glyphs/30/944c33/whatsapp.png"/>

                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-gplus mx-1" target="_blank" href="https://twitter.com/MagicStyle18?s=08">
                        <img src="https://img.icons8.com/ios-glyphs/30/944c33/twitter.png"/>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-li mx-1" target="_blank" href="https://www.instagram.com/magicstyle66/?igshid=i22vamgrwbks">
                        <img src="https://img.icons8.com/material/30/944c33/instagram-new--v1.png"/>
                    </a>
                </li>

            </ul>
           
        </div>
        
        <a class="btn-floating btn-li mx-1" target="_blank" href="https://www.wegrouppro.com"><h6 style="text-align: center">© 2021 All Rights are Reserved For The Magic Style Developed by wegrouppro.com 2021 </h6>                    </a>

        <br>
    </footer>
    <!-- Footer -->

</div>

<script src="{{url('js/user/jquery-3.5.1.min.js')}}"></script>
<script src="{{url('js/user/jquery.min.js')}}"></script>
<script src="{{url('js/user/owl.carousel.min.js')}}"></script>
<script src="{{url('js/user/826a7e3dce.js')}}"></script>
<script src="{{url('js/user/js.js')}}"></script>
<script src="{{url('js/userbootstrap.js')}}"></script>
<script src="{{url('js/user/bootstrap.bundle.js')}}"></script>
<script src="https://kit.fontawesome.com/9e67076c7b.js" crossorigin="anonymous"></script>


<script>

    $(document).ready(function () {
        $(document).on('change', '.product-attr', function () {


   
            var tt = 0;
              var ch = 0;
              
              var parnt  = $(this).data('parent');
              
             
             
            if ($(this).prop('checked')==true) {
                
                
                   var t =  parseFloat($('#'+parnt).text());
                   var p = parseFloat($(this).data('price'));

                 tt = t + p;
             //   $('#feat_price').val(tt);
                $('#'+parnt).text(tt);
                
                    $('#consult_price').val(tt);

            }else {
                var p =  parseFloat($(this).data('price'));
                var t =  parseFloat($('#'+parnt).text());

                tt = t-p;
                //    $('#feat_price').val(t-p);
                     $('#'+parnt).text(tt);
                   
                   $('#consult_price').val(tt);
                   
                 
            }
   
       
        // var ffkey = $(this).data('key');

       //  var id= $('#consult_id').val();
            // $.ajax({
            //     type : 'POST',
            //     url : '{{ route('consult_price_edit') }}',
            //     data : { id : id ,price : tt,ch:ch,ffkey:ffkey, _token : '{{ csrf_token() }}' },

            // });






        });

        // $("#feats").find("checkbox").each(function(){
        //     if ($(this).prop('checked')==true){
        //         $p =  $(this).data('price');
        //         alert($p);
        //     }else {
        //         $p =  $(this).data('price');
        //         alert($p);
        //     }
        // });
    });
</script>






</body>
</html>
