          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="{{url('/index')}}">
                          <i class="icon-dashboard"></i>
                          <span>صفحه اصلی</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span> {{__('users')}}</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="{{route('users.index')}}">{{__('users.index')}}</a></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-cogs"></i>
                          <span>کامنت ها</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="grids.html">گرید</a></li>
                          <li><a class="" href="calendar.html">تقویم</a></li>
                          <li><a class="" href="charts.html">چارت</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-tasks"></i>
                          <span>ابزارهای فرم</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="form_component.html">کامنت فرم</a></li>
                          <li><a class="" href="form_wizard.html">فرم Wizard</a></li>
                          <li><a class="" href="form_validation.html">ارزیابی فرم</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-th"></i>
                          <span>اطلاعات جدول</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="basic_table.html">جدول ساده</a></li>
                          <li><a class="" href="dynamic_table.html">جدول داینامیک</a></li>
                      </ul>
                  </li>
                  <li>
                      <a class="" href="inbox.html">
                          <i class="icon-envelope"></i>
                          <span>ایمیل </span>
                          <span class="label label-danger pull-right mail-info">2</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-glass"></i>
                          <span>عناصر اضافی</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="blank.html">صفحه خالی</a></li>
                          <li><a class="" href="profile.html">پروفایل</a></li>
                          <li><a class="" href="invoice.html">فاکتور</a></li>
                          <li><a class="" href="404.html">404 Error</a></li>
                          <li><a class="" href="500.html">500 Error</a></li>
                      </ul>
                  </li>
                  <li>
                      <a class="" href="login.html">
                          <i class="icon-user"></i>
                          <span>صفحه ورود به سایت</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
