<!DOCTYPE html>
<html>
    <head>
        <title>Admin|Style Result</title>
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
           <div class="float-left"> <span>Style Result</span> </div> 
       
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
                    <th>Style Type</th>
                    <th>Style</th>
                    <th>color</th>
                    <th>makeup</th>
                    <th>hairstyle</th>
                    <th>dress</th>
                    <th>blouse</th>
                    <th>pants</th>
                    <th>skirt design </th>
                    <th>shoes</th>
                    <th>bag</th>
                    <th>jacket</th>
                    <th>accessory</th>
                    <th>appearance</th>
                   
                     
                  </tr>
              </thead>

              <tbody>
              
                <tr style="text-align:center">
                   
                  <td>{{$style_result[0]}}</td>
                  @if(is_array($style_result[1]))
                  <td>{{$style_result[1][0]}} {{$style_result[1][1]}}</td>
                  @else
                  <td>{{$style_result[1]}}</td>  
                  @endif
                  
                  @if(isset($style_result[2]->color))
                  <td>{{$style_result[2]->color}}</td>
                  @else
                  <td>not choosen</td>
                  @endif
                  
                 @if(isset($style_result[2]->makeup))
                  <td>{{$style_result[2]->makeup}}</td>
                  @else
                  <td>not choosen</td>
                  @endif
                 
                 
                  @if(isset($style_result[2]->hairstyle))
                  <td>{{$style_result[2]->hairstyle}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  
                  @if(isset($style_result[2]->dress))
                  <td>{{$style_result[2]->dress}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->blouse))
                  <td>{{$style_result[2]->blouse}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->pants))
                  <td>{{$style_result[2]->pants}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->skirt))
                  <td>{{$style_result[2]->skirt}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->shoes))
                  <td>{{$style_result[2]->shoes}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->bag))
                  <td>{{$style_result[2]->bag}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->jacket))
                  <td>{{$style_result[2]->jacket}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                 
                  @if(isset($style_result[2]->accessory))
                  <td>{{$style_result[2]->accessory}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
                  
                  @if(isset($style_result[2]->appearance))
                  <td>{{$style_result[2]->appearance}}</td> 
                  @else
                  <td>not choosen</td>
                  @endif
            
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