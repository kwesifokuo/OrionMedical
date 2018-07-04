@extends('layouts.default')
@section('content')
<section class="vbox">
           <header class="header bg-white b-b b-light">
<p><span class="label label-success">{{ $visitdetails->name}}</span></p> 
<p class="block"><a href="#" class=""></a> <span class="label label-warning btn-rounded">{{ $visitdetails->visit_type }}</span></p>
 <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visitdetails->opd_number }}</span></p>
 <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($visitdetails->created_on)->diffForHumans() }}</span></p>

  <div class="btn-group pull-right">
                    <p>
        <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $visitdetails->payercode }}</a>
        <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $visitdetails->care_provider }} </a>
                    </p>
              </div>

            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients->fullname }}</div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="#" class="">ID # </a> <span>{{ $patients->patient_id }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $patients->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                        <ul class="list-group no-radius">
                         <h5>
                                <span>Vitals</span>
                               @foreach($myvitals as $vital)
                               <ul>
                                <label class="badge bg-danger"> {{ $vital->created_on }} </label>
                                @if($vital->weight == '') @else <li> Weight <label class="badge bg-info"> {{$vital->weight}}  </label></li> @endif
                                @if($vital->height == '') @else <li> Height <label class="badge bg-info"> {{$vital->height}}  </label></li> @endif

                                 @if($vital->height == '') @else <li> BMI <label class="badge bg-info"> {{ $vital->bmi }}  </label> {{ $vital->bmi_status }}</li> @endif

                                @if($vital->temperature == '') @else <li> Temperature <label class="badge bg-info"> {{$vital->temperature}} ° </label>{{ $vital->temp_status }}</li> @endif
                                @if($vital->pulse_rate == '') @else <li> Pulse Rate <label class="badge bg-info"> {{$vital->pulse_rate}}  </label></li> @endif
                                @if($vital->bp_status == '') @else <li> Blood Pressure <label class="badge bg-info"> {{$vital->sbp }} / {{ $vital->dbp  }} </label>{{$vital->bp_status}}</li> 

                                @endif
{{--                                  @if($vital->waist_circumference == '') @else <li> Waist Circumference <label class="badge bg-info"> {{$vital->waist_circumference }} </label></li> @endif
                                  @if($vital->hip_circumference == '') @else <li> Hip Circumference <label class="badge bg-info"> {{$vital->hip_circumference }} </label></li> @endif

                                   @if($vital->b_fat == '') @else <li> Body Fat <label class="badge bg-info"> {{$vital->b_fat }} </label></li> @endif

                                    @if($vital->v_fat == '') @else <li> Visceral Fat <label class="badge bg-info"> {{$vital->v_fat }} </label></li> @endif

                                     @if($vital->calories == '') @else <li> Calories <label class="badge bg-info"> {{$vital->calories }} </label></li> @endif --}}

                                 </ul>
                                 <div class="line"></div>
                               @endforeach
                              </h5>
                            </ul>
                    {{--     <div>
                          <small class="text-uc text-xs text-muted">Mobile</small>
                          <p>+{{ $patients->mobile_number }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Address</small>
                          <p>{{ $patients->postal_address }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Email</small>
                         <p>{{ $patients->email }}</p>
                          </div> --}}

                          <div>
                            <small class="text-uc text-xs text-muted">Date</small>
                          <p>{{ date('Y-m-d') }}</p>
                          <div class="line"></div>
                          <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->opd_number }}">
                          <p class="block"><a href="#" class="">Visit Number </a> <span class="label label-info btn-rounded">{{ $visitdetails->visitid }}</span></p>
                           
                          <div class="line"></div>
                          <p class="block"><a href="#" class="">Blood Group </a> <span class="label label-danger btn-rounded">{{ $patients->blood_group }}</span></p>
                          
                         
                          <br>
                          </div> 
                           <img src="/images/189316.svg"> 
                        </div>

                    </section>
                  </section>
                </aside>


                <aside class="bg-white">

                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                     <a href="#attach_document" class="bootstrap-modal-form-open badge bg-success pull-right" data-toggle="modal"><i class="fa fa-fw fa-upload"></i>Upload Scan</a> 
                                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->opd_number }}">
                    </header>
                    <section class="scrollable">
                   
                <div class="tab-content">
                    <div class="row">
                  

                     @foreach($images as $keys => $image)
                   

                   <div class="col-md-3 col-sm-4 thumb-lg">
  
                    @if($image->mime == 'docx')
                   <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>  {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @elseif($image->mime == 'pdf')
                     <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>{{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                      @else 
                     <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a> {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @endif        
                      </div>
                    @endforeach

                    </div>
                   {{--  <div class="tab-pane active" id="haematology">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                             <th></th>
                            <th>Scan Name</th>
                            <th>Uploaded By</th>
                            <th>Uploaded On</th>
                          </tr>
                        </thead>
                        <tbody>
                       @foreach($images as $keys => $image)
                         <tr>
                         <td>{{ ++$keys }}</td>
                         @if($image->mime == 'docx')
                         <td><div class="thumb-lg">
                            <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>
                            </div>
                          </td>
                          @elseif($image->mime == 'pdf')
                          <td><div class="thumb-lg">
                            <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>
                            </div>
                          </td>
                          @else
                          <td><div class="thumb-lg">
                            <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a>
                            </div>
                          </td>
                          @endif
                        <td>{{ $image->filename }}</td>
                        <td>{{ $image->created_by }}</td>
                        <td>{{ $image->created_on }}</td>
                        <td>
                            <a href="{!! '/uploads/images/'.$image->filepath !!}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                        <br>
                        <footer>
                          <div class="btn-group pull-right">
                            <p>
                                  <a href="#attach_document" class="bootstrap-modal-form-open badge bg-success" data-toggle="modal"><i class="fa fa-fw fa-upload"></i>Upload Scan</a> 
                                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->visitid }}">
                            </p>
                            </div>
                        </footer>
                      </table>
                     
                    </div>
                    </ul>
                 </div> --}}
                </div>
            </section>
          </section>        
      </aside>


       <aside class="col-lg-3 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                       
                        <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
                           <p>
                       <a href="#" class="btn btn-danger btn-lg pull-right">Amount Due : GHS 0</a>
                      </p>
                            </div>
                          </div>
                        </section>

                         <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
                            <p class="h4 text-dark"><strong>Investigations to perform : <br> <br> @foreach($tests as $val) <label class="badge bg-dark"> {{ $val->investigation }} </label> @endforeach </strong></p>
                            </div>
                          </div>
                        </section>

                      
                      </div>
                    </section>
                    </section>
                    </aside>
    
  </section>
  </section>
</section>
  @stop





      <script type="text/javascript">

 function deleteImage(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the file list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-image-request',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from file list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from list.", "error");   
        } });

    
   }



      </script>


     <div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/bulkupload">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="images[]" multiple /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $visitdetails->patient_id }}">
          <input type="hidden" name="visitid" id="visitid" value="{{ $visitdetails->opd_number }}">
          <input type="hidden" name="file_source" id="file_source" value="Radiology">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>


