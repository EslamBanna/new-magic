<!DOCTYPE html>
<html>
    <head>
        <title>Admin|Body Result</title>
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
           <div class="float-left"> <span>Body Result</span> </div> 
       
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
                    <th>Body Type</th>
                    <th>Neck length</th>
                    <th>Shoulder circumference </th>
                    <th>Chest circumference </th>
                    <th>Lower chest</th>
                     <th>Waist circumference</th>
                    <th>Waist Down</th>
                    <th>Perimeter of the buttocks</th>
                    <th>Circumference of the thighs</th>
                    <th>Length of thighs</th>
                    <th>Leg length</th>
                    <th>Trunk length</th>
                    <th>Total length</th>
                    
                     <th>Physique/Body mass</th> 
                     <th>Body length</th>
                     <th>Neck</th> 
                     <th>Shoulders</th> 
                     <th>Shoulders Shape</th> 
                     <th>Repel</th> 
                     <th>The middle </th> 
                     <th>The Abdomen </th>
                     <th>Trunk</th>
                     <th>Buttocks</th> 
                     <th>The thighs</th> 
                     <th>Leg</th>
                     <th>Leg Muscle</th> 
                     <th>notes</th>
                     
                  </tr>
              </thead>

              <tbody>
              
                <tr style="text-align:center">
                   
                  <td>{{$body_result[0]}}</td>
                  <td>{{$body_result[1]->Neck}}</td>
                  <td>{{$body_result[1]->Shoulder}}</td>
                  <td>{{$body_result[1]->Chest}}</td>
                  <td>{{$body_result[1]->lchest}}</td>
                  <td>{{$body_result[1]->center}}</td>
                  <td>{{$body_result[1]->waist}}</td>
                  <td>{{$body_result[1]->Buttock}}</td>
                  <td>{{$body_result[1]->cthighs}}</td>
                  <td>{{$body_result[1]->Thighl}}</td>
                  <td>{{$body_result[1]->leg}}</td>
                  <td>{{$body_result[1]->Trunkl}}</td>
                  <td>{{$body_result[1]->Total}}</td>
                  
                  <td>{{$body_result[1]->Physique}}</td>
                  <td>{{$body_result[1]->Bodylength}}</td>
                  <td>{{$body_result[1]->NeckT}}</td>
                  <td>{{$body_result[1]->Shoulders}}</td>
                  <td>{{$body_result[1]->ShouldersShape}}</td>
                  <td>{{$body_result[1]->Repel}}</td>
                  <td>{{$body_result[1]->Themiddle}}</td>
                  <td>{{$body_result[1]->TheAbdomen}}</td>
                  <td>{{$body_result[1]->Trunk}}</td>
                  <td>{{$body_result[1]->Buttocks}}</td>
                  <td>{{$body_result[1]->Thethighs}}</td>
                  <td>{{$body_result[1]->Leg}}</td>
                  <td>{{$body_result[1]->LegMuscle}}</td>
                  <td>{{$body_result[1]->notes}}</td>
                  
                  
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