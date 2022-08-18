<!DOCTYPE html>
<html>
    <head>
        <title>Admin|Consultants</title>
        <!--*************Internal style sheet****************-->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/admin/admin-users.css')}}" />
        
    </head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
<!--start side menue--------------------------------------------------------->
@include("admin.layouts.sidenav")
<!-------------------------------------------------------end side menu-->

<!--start main-contenet---------------------------------------------------------->
<div class="content-wrapper">
  <div class="container-fluid">
      <!--start users traffic------------------------------------------------------------->
      <div class="row mt-3">
		<div class="col-12 col-lg-4 col-xl-4">
			<div class="card bg-primary  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{count($all_tests)}}</h4>
							<span class="text-white">Total Tests</span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="far fa-user text-white"></i></div>
					</div>
				</div>
			</div>
		</div>
	
	</div>
       <!-----------------------------------------------end of users traffic area-->
<!--start of recent orders-------------------------------------------------------------------->
 <div class="row">
    <div class="col-12 col-lg-12">
      <div class="card">
        <div class="card-header border-0">
           <div class="float-left"> <span>All Consult Tests</span> </div> 
       
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
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                      <th>Age</th>
                    <th>Job</th>
                    <th>Social Status</th>
                      <th>Apperance</th>
                    <th>Feel</th>
                    <th>Interest</th>
                      <th>Budget</th>
                    <th>Amount</th>
                    <th>Brand</th>
                    
                      <th>Formats</th>
                      <th>Want during consultation</th>
                    <th>Consultation type</th>
                    <th>Consultation Price</th>
                    
                    <th>User Id</th>
                    
                    
                    
                  
                  </tr>
              </thead>

              <tbody>
                @foreach($all_tests as $test)
                <tr style="text-align:center">
                   
                  <td>{{$test->id}}</td>
                  <td>{{$test->name}}</td>
                  <td>
                   {{$test->email}}
                  </td>
                  <td>{{$test->phone}}</td>
                  
                   <td>{{$test->age}}</td>
                  <td>{{$test->job}}</td>
                  <td>
                   {{$test->social_status}}
                  </td>
                  <td>{{$test->apperance}}</td>
                  
                   <td>{{$test->feel}}</td>
                  <td>{{$test->interest}}</td>
                  <td>
                   {{$test->budget}}
                  </td>
                  <td>{{$test->amount}}</td>
                  
                  
                   <td>{{$test->brand}}</td>
                  <td>{{$test->formats}}</td>
                  <td>
                   {{$test->want}}
                  </td>
                  
                  
                  @php
                    
                     $conslt =  App\Models\CunsultantPackages::where('id',$test->consult_id)->first();
                  
                  @endphp
                  <td>@if(!empty($conslt)) {{$conslt->consultation_type}} @else ' '  @endif</td>
                  
                  
                  
                  <td>@if($test->consult_price==0) free @else{{$test->consult_price}} @endif</td>
                
                  
                  
                   <td>{{$test->user_id}}</td>
                
               
               
                
                </tr>
                  
                   
                         
                  @endforeach

                   
         
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