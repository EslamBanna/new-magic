<!DOCTYPE html>
<meta charset="UTF-8" />
<html>
    <head>

        <title>Admin|add-consultant-package</title>

    </head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
<!--start side menue--------------------------------------------------------->
@include("admin.layouts.sidenav")

<!----------------------------------------------------------------End Side menu-->


<!--start main-contenet---------------------------------------------------------->
<div class="content-wrapper">
  <div class="container-fluid">
<!--start add consultation------------------------------------------------------------->
<form id="needs-validation" action="{{route("consultant-packages.store")}}"  method="POST"
enctype="multipart/form-data">
@csrf
<div class="container-fluid">
    <div class="row mt-5 mb-5">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="form theme-form">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Consultation Type</label>
                   <input class="form-control" type="text" name="type" placeholder="Enter consultation type" data-original-title="" title=""  >

                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>الاستشارة باللغة العربية </label>
                   <input class="form-control" type="text" name="type_ar" placeholder="أدخل نوع الاستشارة " data-original-title="" title=""  >

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <!--<label>Consultant Name</label>-->
                    <!--<select class="form-control" >-->
                    <!--  <option>Enter Consultant name</option>-->
                    <!--  @foreach ($consultants as $consultant)-->
                    <!--  <option>{{$consultant["name"]}}</option>-->
                    <!--  @endforeach-->
                    <!--</select>-->
                  </div>
                </div>
{{--                <div class="col-sm-4">--}}
{{--                  <div class="form-group">--}}
{{--                    <label>Consultation price </label>--}}
{{--                    <input type="number" min="0"  class="form-control"Name="price" placeholder="Enter price " required>--}}
{{--                  </div>--}}
{{--                </div>--}}
              </div>
           {{--start features --}}
            <div id="features">
               <div class="row">
               <div class="col-sm-3">
                 <label>Feature English Name</label>
                <input type="text" class="form-control"Name="features_en[]" placeholder="Enter feature " >
              </div>
              <div class="col-sm-3">
                <label>feature Arabic Name </label>
                <input type="tex" class="form-control"Name="features_ar[]" placeholder="Enter feature ">
              </div>

                 <div class="col-sm-3">
                     <div class="form-group">
                         <label>Feature price </label>
                         <input type="number" min="0"  class="form-control"Name="prices[]" placeholder="Enter price " >
                     </div>
                 </div>


                 <div class="col-sm-3">
                     <div class="form-group">
                         <label>Featrure Check</label>
                         <select class="form-control" name="checked[]">
                             <option>Choose  Value</option>

                                 <option value="1">Checked</option>
                                 <option value="0">Not Checked</option>

                         </select>
                     </div>
                 </div>


            </div>
            </div>
            <br>
                <div class="image-ad-more-wrap">
                    <a href="javascript:;" class="image-add-more"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
{{--            <div class="row">--}}
{{--              <div class="col-sm-4">--}}
{{--                <label> الميزة الاولي </label>--}}
{{--               <input type="text" class="form-control"Name="feature_one_ar" placeholder="أدخل الميزة" required>--}}
{{--             </div>--}}
{{--             <div class="col-sm-4">--}}
{{--               <label>  الميزة الثانية  </label>--}}
{{--               <input type="tex" class="form-control"Name="feature_two_ar" placeholder="أدخل الميزة">--}}
{{--             </div>--}}
{{--             <div class="col-sm-4">--}}
{{--               <label>الميزة الثالثة</label>--}}
{{--               <input type="text" class="form-control"Name="feature_three_ar" placeholder="أدخل الميزة">--}}
{{--             </div>--}}
{{--           </div>--}}
           <br>
          {{-- end features --}}
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Enter Description</label>
                    <textarea  class="form-control" id="exampleFormControlTextarea4" name="description" rows="2"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label> أدخل الوصف</label>
                    <textarea  class="form-control" id="exampleFormControlTextarea4" name="description_ar" rows="2"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group mb-0">
                    <button class="btn btn-success mr-3 pull-up" type="submit">Add</button>
                    <a class="btn btn-danger pull-up" href="{{route('consultant-packages.index')}}" data-original-title="" title="">Cancel</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</form>

<!------------------------------------------------------------------------end add consultation-->


  </div>

</div>
<!-------------------------------------------------------------------------end main-contenet-->
<!--start footer------------------------------------------------------------------------------>
@include("admin.layouts.footer")


    <script>
        $(document).ready(function() {
            $(document).on('click', '.image-add-more', function (e) {
             //   alert('hello');
                e.preventDefault();
                $('#features').append(

                    '   <div class="row">\n' +
                    '               <div class="col-sm-3">\n' +
                    '                 <label>Feature English Name</label>\n' +
                    '                <input type="text" class="form-control"Name="features_en[]" placeholder="Enter feature " >\n' +
                    '              </div>\n' +
                    '              <div class="col-sm-3">\n' +
                    '                <label>feature Arabic Name </label>\n' +
                    '                <input type="tex" class="form-control"Name="features_ar[]" placeholder="Enter feature ">\n' +
                    '              </div>\n' +
                    '\n' +
                    '                 <div class="col-sm-3">\n' +
                    '                     <div class="form-group">\n' +
                    '                         <label>Feature price </label>\n' +
                    '                         <input type="number" min="0"  class="form-control"Name="prices[]" placeholder="Enter price " >\n' +
                    '                     </div>\n' +
                    '                 </div>\n' +
                    '\n' +
                    '\n' +
                    '                 <div class="col-sm-3">\n' +
                    '                     <div class="form-group">\n' +
                    '                         <label>Featrure Check</label>\n' +
                    '                         <select class="form-control" name="checked[]">\n' +
                    '                             <option>Choose  Value</option>\n' +
                    '\n' +
                    '                                 <option value="1">Checked</option>\n' +
                    '                                 <option value="0">Not Checked</option>\n' +
                    '\n' +
                    '                         </select>\n' +
                    '                     </div>\n' +
                    '                 </div>\n' +
                    '\n' +
                    '            </div>'

                );
            });
        });
    </script>


<!-----------------------------------------------------------end of main main page wrapper----------------------------------------->

</body>
</html>
