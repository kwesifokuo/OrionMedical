  @role(['Receptionist','System Admin','Billing','Doctor','Imaging','Nurse','Medical Records Manager','Medical Records Assistant','Medical Assistant','Cashier','Marketing','Purchases','Laboratory','Pharmacy Technician','Pharmacist','Dentist','Ophthalmologist','Dietian','Specialist','Dental Nurse','Dental Receptionist','Nurse Assistant','Special Admin','Claims Manager'])
 <aside class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">
            <header class="header lter text-center clearfix" style="background-color:#1ABC9C">
              <div class="btn-group">
               
              </div>
            </header>
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="{{ route('dashboard') }}"   class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Dashboard</span>
                      </a>
                    </li>

                   <li >
                      <a href="/event-calendar"  >
                        
                        <i class="fa fa-calendar icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Appointment</span>
                      </a>
                    </li>


                    <li >
                      <a href="/register-quick"  >
                        <i class="fa fa-laptop icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Tab</span>
                      </a>
                    </li>

                    
                    <li>
                      <a href="#layout"  >
                        <i class="fa fa-wheelchair icon">
                          <b class="bg-warning"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Records</span>
                      </a>
                       @role(['Medical Records Manager','Medical Records Assistant','System Admin','Nurse','Nurse Assistant','Special Admin','Claims Manager'])
                      <ul class="nav lt">
                        <li >
                          <a href="/active-patients" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Patient List</span>
                          </a>
                        </li>
                       
                      </ul>
                      @endrole

                      @role(['Receptionist','Medical Records Manager','Medical Records Assistant','System Admin','Nurse','Special Admin','Claims Manager'])
                      <ul class="nav lt">
                        <li >
                          <a href="/new-opd" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>OPD</span>
                          </a>
                        </li>
                      </ul>
                      
                      <ul class="nav lt">
                        <li >
                          <a href="/new-opd" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>IPD</span>
                          </a>
                        </li>
                      </ul>
                      <ul class="nav lt">
                        <li >
                          <a href="/event-calendar" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Calendar</span>
                          </a>
                        </li>
                      </ul>
                      <ul class="nav lt">
                        <li >
                          <a href="/saved-documents" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Resources</span>
                          </a>
                        </li>
                      </ul>
                       <ul class="nav lt">
                        <li >
                          <a href="/company-directory" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Contacts</span>
                          </a>
                        </li>
                      </ul>
                       <ul class="nav lt">
                        <li >
                          <a href="#" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Tasks</span>
                          </a>
                        </li>
                      </ul>
                       <ul class="nav lt">
                        <li >
                          <a href="/notes-index" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Notes</span>
                          </a>
                        </li>
                      </ul>
                      <ul class="nav lt">
                        <li >
                          <a href="/whatsapp-messages" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Whatsapp Message</span>
                          </a>
                        </li>
                      </ul>

                        <ul class="nav lt">
                        <li >
                          <a href="/loyalty-messages" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Loyalty Usage</span>
                          </a>
                        </li>
                      </ul>
                      @endrole
                    </li>
                    
                    @role(['Nurse','System Admin','Nurse Assistant','Special Admin'])
                    <li >
                      <a href="/nurse-station"  >
                        
                        <i class="fa fa-stethoscope icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Nurse Station</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Doctor','System Admin'])
                     <li >
                      <a href="/opd-consultation"  >
                        
                        <i class="fa fa-user-md  icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Doctor Station</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Nurse','System Admin'])
                     <li >
                      <a href="/available-rooms"  >
                        
                        <i class="fa fa-hospital-o icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Room Mgt.</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Pharmacist','System Admin','Pharmacy Technician','Special Admin'])
                    <li >
                      <a href="/prescriptions-pending"  >
                        
                        <i class="fa fa-medkit icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Pharmacy</span>
                      </a>
                    </li>
                    @endrole

                    <li>
                      <a href="/store-requisitions"  >
                        
                        <i class="fa fa-shopping-cart icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Store Requisitions</span>
                      </a>
                    </li>
                   
                  
                    @role(['Billing','System Admin','Cashier','Special Admin','Pharmacist','Pharmacy Technician'])
                     <li >
                      <a href="/billing-index"  >
                       
                        <i class="fa fa-money icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Billing</span>
                      </a>
                    </li>
                    @endrole

                     @role(['Billing','System Admin','Cashier','Claims Manager'])
                     <li >
                      <a href="/insurance-claims-portal"  >
                       
                        <i class="fa fa-gavel icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Claims</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Ophthalmologist','System Admin'])
                    <li >
                      <a href="/ophthalmology"  >
                        
                        <i class="fa fa-eye icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Eye</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Dentist','Dental Nurse','System Admin','Dental Receptionist'])
                    <li >
                      <a href="/dental"  >
                        
                        <i class="fa fa-smile-o icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Dental</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Laboratory','System Admin'])
                    <li >
                      <a href="/laboratory"  >
                       
                        <i class="fa fa-plus-square icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Laboratory</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Dietian','System Admin'])
                    <li >
                      <a href="/dietian-review"  >
                       
                        <i class="fa fa-heart-o icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Dietitian</span>
                      </a>
                    </li>
                    @endrole
                     @role(['System Admin'])
                     <li >
                      <a href="mail.html"  >
                        
                        <i class="fa fa-users icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>HR</span>
                      </a>
                    </li>
                    @endrole
                    @role(['System Admin','Imaging'])
                    <li >
                      <a href="/imaging"  >
                        
                        <i class="fa fa-paperclip icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Radiology</span>
                      </a>
                    </li>
                    @endrole
                    @role(['System Admin','Imaging'])
                    <li >
                      <a href="/orionpacs/viewers/static/index.html"  >
                        
                        <i class="fa fa-paperclip icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>PACS</span>
                      </a>
                    </li>
                    @endrole
                    
                    <li >
                      <a href="/saved-documents"  >
                        
                        <i class="fa fa-folder-open icon">
                          <b class="bg-primary dker"></b>
                        </i>
                        <span>Documents</span>
                      </a>
                    </li>

                    

                    
                     <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Reports</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/medical-reports" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Dashboard</span>
                          </a>
                        </li>

                       
                      </ul>
                    </li>
                   @role(['System Admin'])
                  <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-primary"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Setup</span>
                      </a>
                      <ul class="nav lt">
                      <li >
                          <a href="/service-charges" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Tarrif</span>
                          </a>
                        </li>
                        <li >
                          <a href="/add-template" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Medical Templates</span>
                          </a>
                        </li>
                        <li >
                          <a href="/reporting" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Banking</span>
                          </a>
                        </li>
                         <li >
                          <a href="/reporting" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Communication</span>
                          </a>
                        </li>
                        <li >
                          <a href="/company.index" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Company</span>
                          </a>
                        </li>
                        <li >
                          <a href="/manage-users" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>User Management</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    @endrole
                    <li >
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      {{ Auth::user()->getNameOrUsername() }} <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No contacts in your lists.</p>
                      <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from  {{   $mycompany->name }} Facebook</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
              </div>
            </footer>
          </section>
        </aside>
@endrole  