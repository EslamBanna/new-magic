<!DOCTYPE html>
<meta charset="UTF-8" />
<html>
    <head>

        <title>Admin|edit-consultant-package</title>

    </head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
<!--start side menue--------------------------------------------------------->
@include("admin.layouts.sidenav")

<!----------------------------------------------------------------End Side menu-->


<!--start main-contenet---------------------------------------------------------->
<div class="content-wrapper">
  <div class="container-fluid">
<!--start add consultation------------------------------------------------------------->
<form id="frm"class="mt-5 mb-5" id="needs-validation" novalidate="" action="{{route('consultant-packages.update',$cunsultantPackage[0]->id)}}" method="post" enctype="multipart/form-data">
  @csrf
  @method("put")
{{-- {{dd($cunsultantPackage[0])}} --}}
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
                   <input class="form-control" type="text"  value="{{$cunsultantPackage[0]->consultation_type_en}}" name="type" placeholder="Enter consultation type" data-original-title="" title=""  required>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>الاستشارة باللغة العربية </label>
                   <input class="form-control" type="text" name="type_ar" value="{{$cunsultantPackage[0]->consultation_type_ar}}"  placeholder="أدخل نوع الاستشارة " data-original-title="" title=""  required>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Consultant Name</label>
                    <select class="form-control">
                      <option>Enter Consultant name</option>
                      @foreach ($consultants as $consultant)
                      <option>{{$consultant["name"]}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
{{--                <div class="col-sm-4">--}}
{{--                  <div class="form-group">--}}
{{--                    <label>Consultation price </label>--}}
{{--                    <input type="number" min="0"  class="form-control"Name="price"  value="{{$cunsultantPackage[0]->price}}" placeholder="Enter price " required>--}}
{{--                  </div>--}}
{{--                </div>--}}
              </div>
           {{--start features  $features --}}

                @if(!empty($features) && count($features)>0)
                      <div id="features">
                    @foreach($features as $feature)

                 
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Feature English Name</label>
                                <input type="text" class="form-control"Name="features_en[]" placeholder="Enter feature" value="{{$feature->feature}}">
                            </div>
                            <div class="col-sm-3">
                                <label>feature Arabic Name </label>
                                <input type="tex" class="form-control"Name="features_ar[]" placeholder="Enter feature " value="{{$feature->feature_ar}}">
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Feature price </label>
                                    <input type="number" min="0"  class="form-control"Name="prices[]" placeholder="Enter price " value="{{$feature->price}}">
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Featrure Check</label>
                                    <select class="form-control" name="checked[]">
                                        <option>Choose  Value</option>

                                        <option value="1"  @if($feature->checked == 1) selected @else '' @endif>Checked</option>
                                        <option value="0"  @if($feature->checked == 0) selected @else '' @endif>Not Checked</option>

                                    </select>
                                </div>
                            </div>


                        </div>
                   
                    @endforeach
                 </div>
                @else
                    <div id="features">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Feature English Name</label>
                                <input type="text" class="form-control"Name="features_en[]" placeholder="Enter feature " required>
                            </div>
                            <div class="col-sm-3">
                                <label>feature Arabic Name </label>
                                <input type="tex" class="form-control"Name="features_ar[]" placeholder="Enter feature ">
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Feature price </label>
                                    <input type="number" min="0"  class="form-control"Name="prices[]" placeholder="Enter price " required>
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
                @endif
            <br>


                <div class="image-ad-more-wrap">
                    <a href="javascript:;" class="image-add-more"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
          {{-- end features --}}
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Enter Description</label>
                    <textarea required class="form-control"  id="exampleFormControlTextarea4" name="description" rows="2">{{$cunsultantPackage[0]->description_en}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label> أدخل الوصف</label>
                    <textarea required class="form-control" value="{{$cunsultantPackage[0]->description_ar}}" id="exampleFormControlTextarea4" name="description_ar" rows="2">{{$cunsultantPackage[0]->description_ar}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group mb-0">
                    <button class="btn btn-success mr-3 pull-up" onclick="submitForm()" type="submit">Edit</button>
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
                '                <input type="text" class="form-control"Name="features_en[]" placeholder="Enter feature " required>\n' +
                '              </div>\n' +
                '              <div class="col-sm-3">\n' +
                '                <label>feature Arabic Name </label>\n' +
                '                <input type="tex" class="form-control"Name="features_ar[]" placeholder="Enter feature ">\n' +
                '              </div>\n' +
                '\n' +
                '                 <div class="col-sm-3">\n' +
                '                     <div class="form-group">\n' +
                '                         <label>Feature price </label>\n' +
                '                         <input type="number" min="0"  class="form-control"Name="prices[]" placeholder="Enter price " required>\n' +
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
<script>
  function submitForm() {

   var frm = document.getElementById('frm');
  //  frm.submit(); // Submit the form
   frm.clear();  // Reset all form data
   return false; // Prevent page refresh
}
</script>
</body>
</html>
