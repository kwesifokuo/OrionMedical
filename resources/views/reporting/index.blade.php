@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Reports</li>
                
              </ul>
            
              <div class="row">

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 OPD
                </header>
                <div class="list-group bg-white">
                  <a href="/patient-doctor-ratio" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Summary of Patient to Doctor Ratio
                  </a>

                  <a href="/patient-visit-stats" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Summary of Visit Statistics
                  </a>

                    <a href="/medical-summary-department-count" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary By Department - Count
                  </a>

                   <a href="/medical-summary-department" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary By Department
                  </a>


                  <a href="/vital-temperature" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Visits Vrs Temperature Summary
                  </a>
                   <a href="/vital-bmi" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Vital Summary for BMI
                  </a>

                   <a href="/vital-blood-pressure" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Vital Summary for BP
                  </a>

                       <a href="/morbidity-assessment" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Morbidity Assessment Report
                  </a>

                  <a href="/patient-list" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Patient List
                  </a>

                  <a href="/form-patient-visit" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Patient Visits
                  </a>


                </div>
              </section>
              </div>






               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-info portlet-item">
                <header class="panel-heading">
                 Revenue
                </header>

              
                <div class="list-group bg-white">
                  @role(['System Admin','Billing'])
                  <a href="/bill-listing" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Bill Listings and Summary
                  </a>
                  <a href="/collection-summary" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Collection Summary Report
                  </a>

                   <a href="/locum-sheet" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Locum Sheet
                  </a>
                @endrole

                 @role(['System Admin'])
                  <a href="/medical-summary-consultation" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary By Consultation
                  </a>
                  <a href="/medical-summary-department" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary By Department
                  </a>

                   <a href="/medical-summary-department-count" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary By Department - Count
                  </a>
                  
                     <a href="/medical-summary-doctors" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary By Doctors
                  </a>

                     <a href="/medical-summary-department-all" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary for All Department
                  </a>

                     <a href="/medical-summary-pharmarcy" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary for Pharmacy
                  </a>
                  @endrole

                </div>
              </section>
              </div>

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-success portlet-item">
                <header class="panel-heading">
                 Pharmacy
                </header>
                <div class="list-group bg-white">
                   <a href="/medical-summary-pharmarcy" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Revenue Summary for Pharmacy
                  </a>
                  <a href="/sales-main" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Sales report
                  </a>
                  <a href="/sales" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Drug List
                  </a>
                  <a href="/sales-stock-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Stock List
                  </a>
                
                </div>
              </section>
              </div>

          
    
              </div>
              

            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop