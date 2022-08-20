<!DOCTYPE html>
<html>
    <head>
        <title>Admin|feedbacks</title>
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
<!--start of recent orders-------------------------------------------------------------------->
 <div class="row">
    <div class="col-12 col-lg-12">
      <div class="card">
        
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover" id="example">
              <thead>
                  <tr style="text-align: center">
                    <!-- <th>Photo</th> -->
                    <th>#ID</th>
                    <th>rate</th>
                    <th>title</th>
                    <th>comment</th>
                    <th>Action</th>
                    <th>created at</th>
                  </tr>
              </thead>

              <tbody>
                @foreach($feedbacks as $feedback)
                <tr style="text-align: center">
                   
                  <td>{{$feedback->id}}</td>
                  <td>{{$feedback->rate}}</td>
                  <td>{{$feedback->title}}</td>
                  <td>{{$feedback->comment}}</td>
                  <td>{{$feedback->created_at}}</td>
                  <td>
                     <!-- <i class="far fa-trash-alt " title="delete"></i> -->
                      <form action="{{route('delete.feedback',$feedback->id)}}" method="post">
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