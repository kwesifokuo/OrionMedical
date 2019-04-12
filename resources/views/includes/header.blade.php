    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="/images/glogo.png" class="m-r-sm">{{ $mycompany->name }}</a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
            <i class="fa fa-building-o"></i> 
            <span class="font-bold">Activity</span>
          </a>@if(Auth::check()) 
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
            <div class="wrapper lter m-t-n-xs">
              <a href="#" class="thumb pull-left m-r">
                <img src="/images/avatar_default.jpg" class="img-circle">
              </a>
              <div class="clear">
                <a href="#"><span class="text-white font-bold">{{ Auth::user()->getNameOrUsername() }}</span></a>
                <small class="block">{{ Auth::user()->getRole() }}</small>
                <a href="#" class="btn btn-xs btn-success m-t-xs">Upgrade</a>
              </div>
            </div>
           
          </section>
        </li>

         {{-- <li class="dropdown">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
            <i class="fa fa-shopping-cart"></i> 
            <span class="font-bold">Make Store Requisition</span>
          </a>
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
            <div class="wrapper lter m-t-n-xs">
              <a href="#" class="thumb pull-left m-r">
                <img src="/images/avatar_default.jpg" class="img-circle">
              </a>
              <div class="clear">
                <a href="/consumables-list"><span class="text-white font-bold"></span></a>
                <small class="block"></small>
                <a href="/consumables-list" class="btn btn-xs btn-success m-t-xs">Make Requisition</a>
              </div>
            </div>
           
          </section>
        </li>

         <li class="dropdown">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
            <i class="fa fa-gavel"></i> 
            <span class="font-bold">Rx Claims</span>
          </a>
          <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
            <div class="wrapper lter m-t-n-xs">
              <a href="#" class="thumb pull-left m-r">
                <img src="/images/avatar_default.jpg" class="img-circle">
              </a>
              <div class="clear">
                <a href="192.168.100.41:85/rxclaim_client" target="_new"><span class="text-white font-bold"></span></a>
                <small class="block"></small>
                <a href="/192.168.100.41:85/rxclaim_client" target="_new" class="btn btn-xs btn-success m-t-xs">Connect</a>
              </div>
            </div>
           
          </section>
        </li>
         --}}
      </ul>      
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
      <li class="hidden-xs">
          <a href="/consumable-list" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-shopping-cart"></i>
            <span class="badge badge-sm up bg-info m-l-n-sm count">{{ $notifications->count() }}</span>
          </a>
         {{--  <section class="dropdown-menu aside-xl">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong>You have <span class="count">{{$notifications->count() }}</span> notifications</strong>
              </header>
            
              <footer class="panel-footer text-sm">
                <a href="#assign-consumable" class="bootstrap-modal-form-open pull-right"  id="edit" name="edit" alt="edit" data-toggle="modal"><i class="fa fa-plus"></i></a>
                <a href="#assign-consumable" class="bootstrap-modal-form-open"  id="edit" name="edit" alt="edit" data-toggle="modal">See all the requistions</a>
              </footer>
            </section>
          </section> --}}
        </li>

        <li class="hidden-xs">
          <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge badge-sm up bg-danger m-l-n-sm count">{{$notifications->count() }}</span>
          </a>
          <section class="dropdown-menu aside-xl">
            <section class="panel bg-white">
              <header class="panel-heading b-light bg-light">
                <strong>You have <span class="count">{{$notifications->count() }}</span> notifications</strong>
              </header>
              <div class="list-group list-group-alt animated fadeInRight">
              @foreach($notifications as $notify)
                <a href="#" class="list-group-item">
                  <span class="pull-left thumb-sm">
                    <img src="/images/avatar_default.jpg" alt="John said" class="img-circle">
                  </span>
                  <span class="media-body block m-b-none">
                    {{ $notify->name }}<br>
                    <small class="text-muted">{{ Carbon\Carbon::parse($notify->created_on)->diffForHumans() }}</small>
                  </span> 
                </a>
                @endforeach
              </div>
              <footer class="panel-footer text-sm">
                <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
              </footer>
            </section>
          </section>
        </li>
        <li class="dropdown hidden-xs">
          <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
          <section class="dropdown-menu aside-xl animated fadeInUp">
            <section class="panel bg-white">
              <form role="search">
                <div class="form-group wrapper m-b-none">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div>
              </form>
            </section>
          </section>
        </li>
       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img src="/images/avatar_default.jpg">
            </span>
            {{ Auth::user()->getNameOrUsername() }} <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <span class="arrow top"></span>
            <li>
              <a href="/password/reset">Reset Password</a>
            </li>
            <li>
              <a href="#">Profile</a>
            </li>
            <li>
              <a href="/consumables-list" class="bootstrap-modal-form-open"  id="edit" name="edit" alt="edit" data-toggle="modal">Request Consumable</a>
            </li>
            <li>
              <a href="#">
                <span class="badge bg-danger pull-right">3</span>
                Notifications
              </a>
            </li>
            <li>
              <a href="#">Help</a>
            </li>
            <li class="divider"></li>
            <li>
             <a href="{{ route('auth.signin') }}" >Logout</a>
            </li>
          </ul>
           @endif
        </li>
      </ul>      
    </header>


    