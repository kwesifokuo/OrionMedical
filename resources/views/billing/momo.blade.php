
@extends('layouts.default')
@section('content')
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
                <div class="x_panel">
                                <div class="x_title">
                                    <h2>MTN Mobile Money - Send Payment Request<small><!-- Please enter any additional message here --></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" method="post" action="//splus.cdhgroup.co:8087/TP_SendPayment" id="requestForm">

                             

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">App Code <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="app_code" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="app_code" placeholder="" readonly="true" required="required" type="text">
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">App Key <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="app_key" name="app_key" readonly="true" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Client Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="name" type="text" name="name" readonly="true"  class="form-control col-md-7 col-xs-12" required="required" value="{{ $bills[0]->fullname }}">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Paying Mobile No <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" id="mobile_no" name="mobile_no" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                       
                                      

                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="amount" type="text" name="amount" readonly="true"  class="form-control col-md-7 col-xs-12" required="required" value="{{ $outstanding }}">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Operator</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="operator" type="text" name="operator" value="MTN" readonly="true" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div>

                                        

                                        
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                                <button id="send" type="submit" class="btn btn-success">Send Payment</button>
                                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
@stop
<script type="text/javascript">
    



$(document).ready(function(){
        
            $("#requestForm").submit(function(e){
                e.preventDefault();
                var form = $(this);
                var action = form.attr("action");
                var data = form.serializeArray();

                $.ajax({
                            url: action,
                            dataType: 'json',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify(getFormData(data)),
                            success: function(data){
                                console.log("DATA POSTED SUCCESSFULLY : "+data['payment_id']);
                            },
                            error: function( jqXhr, textStatus, errorThrown ){
                                console.log( errorThrown );
                            }
                });
        });
});

//utility function
function getFormData(data) {
   var unindexed_array = data;
   var indexed_array = {};

   $.map(unindexed_array, function(n, i) {
    indexed_array[n['name']] = n['value'];
   });

   return indexed_array;
}





</script>
