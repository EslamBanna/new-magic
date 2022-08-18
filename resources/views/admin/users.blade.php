<!DOCTYPE html>
<html>
    <head>
        <title>Admin|users</title>
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
		<div class="col-12 col-lg-3 col-xl-3">
			<div class="card bg-primary  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{count($users)}}</h4>
							<span class="text-white">Total Users</span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="fas fa-user text-white"></i></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-3 col-xl-3">
			<div class="card bg-success  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{$face_tested}}</h4>
							<span class="text-white">Test Face</span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="far fa-grin-beam text-white"></i></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-3 col-xl-3">
			<div class="card bg-danger  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{$body_tested}}</h4>
							<span class="text-white">Test Body </span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="fas fa-child text-white"></i></div>
					</div>
				</div>
			</div>
		</div>
    <div class="col-12 col-lg-3 col-xl-3">
			<div class="card bg-primary  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{$style_tested}}</h4>
							<span class="text-white">Test Style </span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="fas fa-star text-white"></i></div>
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
           <div class="float-left"> <span>Recent Users</span> </div> 
           <div class="float-right"><a class="btn btn-outline-info" href="{{route('users.create')}}"><i class="fas fa-user mr-1"></i>Add User</a></div>  
        </div>      
           <div class="card-action">
              <div class="dropdown">
                <a  id="user-dropdown" class="collapse">
                  <i class="fas fa-ellipsis-h"></i>
                </a>
              </div>
           </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover" id="example">
              <thead>
                  <tr style="text-align: center">
                    <!-- <th>Photo</th> -->
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Face Type</th>
                    <th>Body Type</th>
                    <th>Style</th>
                    <th >Date</th>
                    <th>Action</th>
                  </tr>
              </thead>

              <tbody>
                @foreach($users as $user)
                <tr style="text-align: center">
                   
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>
                   {{$user->email}}
                  </td>
                  <td>
                    @if($user->first_exam)
                    <form  action="{{route('admin.faceResult',$user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <button type="submit" class="btn " style="background-color: #f7941d">  {{$user->first_exam->face_shape}}</button>
               

                    </form>
                    @else
                        Not Tested Yet
                    @endif
                    
                  </td>
                  <td>
                    @if($user->second_exam)
                      <form  action="{{route('admin.bodyResult',$user->id)}}" method="post">
                        @csrf
                         <button type="submit" class="btn " style="background-color: #f7941d">{{$user->second_exam->body}}</button>
                            </form>
                
                    @else
                        Not Tested Yet
                    @endif         
                    </td>
                    <td>
                      @if($user->third_exam)
                      @if (is_array($user->third_exam->style))
                      <form  action="{{route('admin.styleResult',$user->id)}}" method="post">
                        @csrf
                         <button type="submit" class="btn " style="background-color: #f7941d">{{$user->third_exam->style[0]}},{{$user->third_exam->style[1]}}</button>
                            </form>
                      @else
                           <form  action="{{route('admin.styleResult',$user->id)}}" method="post">
                        @csrf
                         <button type="submit" class="btn " style="background-color: #f7941d">{{$user->third_exam->style}}</button>
                            </form>
                      
                      @endif
                      @else
                          Not Tested Yet
                      @endif         
                      </td>                  <td>{{$user->created_at}}</td>
                  <td>
                     <!-- <i class="far fa-trash-alt " title="delete"></i> -->
                      <form action="{{route('users.destroy',$user)}}" method="post">
                          @csrf
                          @method("delete")
                          <input type="submit" value="Delete" class="btn btn-outline-danger">
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