<!DOCTYPE html>
<html>
    <head>
        <title>Admin|Face Result</title>
        <!--*************Internal style sheet****************-->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/admin/admin-users.css')}}" />
        
    </head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
<!--start side menue--------------------------------------------------------->
@include("admin.layouts.sidenav")
<!-------------------------------------------------------end side menu-->

<!--start main-contenet---------------------------------------------------------->
<div class="content-wrapper">
 
       <!-----------------------------------------------end of users traffic area-->
<!--start of recent orders-------------------------------------------------------------------->
 <div class="row">
    <div class="col-12 col-lg-12">
      <div class="card">
        <div class="card-header border-0">
           <div class="float-left"> <span>Face Result</span> </div> 
       
        </div>      
           <div class="card-action">
              <div class="dropdown">
                <a  id="user-dropdown" class="collapse">
                  <i class="fas fa-ellipsis-h"></i>
                </a>
              </div>
           </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover">
              <thead>
                  <tr style="color:blue; background-color:yellow;text-align:center">
                    <!-- <th>Photo</th> -->
                     <th>Face Shape</th>
                    <th>ForeHead Size</th>
                    <th>cheek Size</th>
                    <th>Face Length</th>
                    <th>jaw Size</th>
                      <th>Chin Shape</th>
                    <th>salience in the jaw</th>
                   
                  
                  </tr>
              </thead>

              <tbody>
              
                <tr style="text-align:center">
                    <td>
                   {{$face_result->face_shape}}
                  </td>
                  <td>{{$face_result->ForeHead}}</td>
                  <td>{{$face_result->cheek}}</td>
                  <td>
                 {{$face_result->facelength}}
                  </td>
                  <td>{{$face_result->jaw}}</td>
                  
                   <td>{{$face_result->Chin_Shape}}</td>
                  <td>{{$face_result->salienceradio}}</td>
                 
                  
                
                </tr>
                  
                   
                         
                 

                   
         
              </tbody>
          </table>
        </div>
      </div>
    </div>
   </div> 
  
  

<!------------------------------------------------------------------------end of users-->


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