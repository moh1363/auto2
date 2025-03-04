@php

$countapprovals=\App\Models\MorakhasiApproval::where('approved_time',null)->get();
@endphp
<!-- Brand Logo -->
<a href="#" class="brand-link ">
      <img src="{{asset('dist/img/iran.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          {{-- <div class="image">
            <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
          </div> --}}
          <div class="info">
            <a href="{{route('users.show',auth()->user()->id)}}" class="d-block">{{auth()->user()->firstname}}{{auth()->user()->lastname}}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
              @if(auth()->user()->can('مدیریت کاربران'))

              <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  {{__('users.managment')}}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p> {{__('users.index')}} </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('post-titles.index')}}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{__('posttitle.index')}} </p>
                  </a>
                </li>
                  <li class="nav-item">
                      <a href="{{route('roles.index')}}" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>{{__('roles.index')}} </p>
                      </a>
                  </li>


              </ul>

            </li>
              @endif

              <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-user"></i>
                      <p>
                          {{__('personal.file')}}
                          <i class="right fa fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li style="padding-right: 10px" class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fa fa-pie-chart"></i>
                              <p>
                                  {{__('personal.file.morakhasi')}}
                                  <i class="right fa fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{route('morakhasi.index')}}" class="nav-link">
                                      <i class="fa fa-circle-o nav-icon"></i>
                                      <p> {{__('morakhasi.index')}} </p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{route('morakhasi.create')}}" class="nav-link">
                                      <i class="fa fa-circle-o nav-icon"></i>
                                      <p> {{__('morakhasi.create')}} </p>
                                  </a>
                              </li>

                  </ul>
                      <li class="nav-item">
                          <a href="{{route('users.show',auth()->user()->id)}}" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>{{__('personal.file.show')}} </p>
                          </a>
                      </li>
              </li>


          </ul>
              @can('تایید مرخصی')

              @if(count($countapprovals)>0)
              <li class="nav-item">
                  <a href="{{route('approval.index')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{__('morakhasiapproval.index')}} </p>
                  </a>
              </li>
            @endif
            @endcan
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
