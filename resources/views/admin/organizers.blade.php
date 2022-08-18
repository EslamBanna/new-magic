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
							<h4 class="text-white mb-0">{{count($organizers)}}</h4>
							<span class="text-white">Total Organizers</span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="far fa-user text-white"></i></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4 col-xl-4">
			<div class="card bg-success  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{$numOfAdmins}}</h4>
							<span class="text-white">Admins</span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="fas fa-user-cog text-white"></i></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4 col-xl-4">
			<div class="card bg-danger  pull-up">
				<div class="card-body">
					<div class="media">
						<div class="media-body text-left">
							<h4 class="text-white mb-0">{{count($organizers)-$numOfAdmins}}</h4>
							<span class="text-white">Consultants</span>
						</div>
						<div class="align-self-center w-circle-icon rounded border border-white">
							<i class="fas fa-user-shield text-white"></i></div>
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
           <div class="float-left"> <span>Recent Organizers</span> </div> 
           <div class="float-right"><a class="btn btn-outline-info" href="{{route('organizers.create')}}"><i class="fas fa-user mr-1"></i>Add Organizer</a></div>  
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
                  <tr>
                    <!-- <th>Photo</th> -->
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
              </thead>

              <tbody>
                @foreach($organizers as $organizer)
                <tr>
                   
                  <td>{{$organizer->id}}</td>
                  <td>{{$organizer->name}}</td>
                  <td>
                   {{$organizer->email}}
                  </td>
                  <td>{{$organizer->phone}}</td>
                  <td>{{$organizer->created_at}}</td>
                  <td>
                  @if($organizer['role']!=='admin')
                  <a href="{{route('organizers.edit',$organizer)}}" title="edit"><i class="fas fa-user-edit" style="font-size:1rem;"></i></a>{{$organizer->role}}
                  <p>Category :   {{$organizer->consultant_category}}

                  @else
                  {{$organizer->role}}
                  @endif
                  </td>
                  @if($organizer['role']!=='admin')

                  <td>
                     <!-- <i class="far fa-trash-alt " title="delete"></i> -->
                      <form action="{{route('organizers.destroy',$organizer)}}" method="post">
                          @csrf
                          @method("delete")
                          <input type="submit" value="Delete" style="width: 85px" class="btn btn-outline-danger">
                      </form>
                   
                  </td>
                  @else
                  <td>

                  {{-- <form action="{{route('support.edit',$organizer)}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method("put")
                    <input type="submit" value="Contact" style="font-size:14px" class="btn btn-outline-danger">
                </form> --}}
                {{-- <a href="{{route('support.edit',$organizer)}}" title="contact"><input  value="Contact" style="width: 85px" class="btn btn-outline-primary"> </a> --}}
              </td>
                  @endif
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