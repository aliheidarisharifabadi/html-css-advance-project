<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="user-pro">
                <a href="#" class="waves-effect"><img src="{{asset('assets/images/users/varun.jpg')}}" alt="user-img"
                                                      class="img-circle"> <span class="hide-menu"> {{getUserFullName()}}<span
                                class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:void(0)"><i class="ti-user"></i> پروفایل من</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> خروج</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>

            <li class="nav-small-cap m-t-10">--- منوی اصلی</li>
            <li>
                <a href="{{route('dashboard.index')}}"
                   class="waves-effect {{\Request::route()->getName() === 'dashboard.index' ? 'active' : ''}}">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw fa-fw"></i> <span
                            class="hide-menu"> داشبورد </span>
                </a>
            </li>

            <li class="nav-small-cap m-t-10">--- کاربران</li>
            <li>
                <a href="{{route('user.index')}}"
                   class="waves-effect {{\Request::route()->getName() === 'user.index' ? 'active' : ''}}">
                    <i class="zmdi zmdi-accounts zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu"> لیست کاربران
                        <span class="label label-rouded label-purple pull-left">{{session('whiteUsersCount')}}</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('user.index.black')}}"
                   class="waves-effect {{\Request::route()->getName() === 'user.index.black' ? 'active' : ''}}"><i
                            class="zmdi zmdi-pin zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu"> لیست سیاه
                        <span class="label label-rouded label-inverse pull-left">{{session('blackUsersCount')}}</span>
                    </span>
                </a>
            </li>

            <li class="nav-small-cap m-t-10">--- کارت ویزیت</li>
            <li>
                <a href="{{route('vcard.index')}}"
                   class="waves-effect {{\Request::route()->getName() == 'vcard.index' ? 'active' : ''}}">
                    <i class="zmdi zmdi-library zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu"> لیست کارت
                        <span class="label label-rouded label-info pull-left">{{session('whiteVcardsCount')}}</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('vcard.index.black')}}"
                   class="waves-effect {{\Request::route()->getName() == 'vcard.index.black' ? 'active' : ''}}">
                    <i class="zmdi zmdi-view-list-alt zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu"> لیست سیاه
                        <span class="label label-rouded label-inverse pull-left">{{session('blackVcardsCount')}}</span>
                    </span>
                </a>
            </li>

            <li class="nav-small-cap m-t-10">--- گزارشات</li>
            <li>
                <a href="{{route('report.index')}}" class="waves-effect {{\Request::route()->getName() == 'report.index' ? 'active' : ''}}">
                    <i class="zmdi zmdi-blur-circular zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu"> ریپورتی ها
                        <span class="label label-rouded label-danger pull-left">{{session('activeReportsCount')}}</span>
                    </span>
                </a>
            </li>

            <li class="nav-small-cap m-t-10">--- نوتیفیکیشن</li>
            <li>
                <a href="#" class="waves-effect {{strpos(\Request::route()->getName(), 'notification.') !== false ? 'active' : ''}}">
                    <i class="zmdi zmdi-notifications-active zmdi-hc-fw fa-fw"></i>
                    <span class="hide-menu">نوتیفیکیشن
                        <span class="fa arrow"></span>
                        <span class="label label-rouded label-purple pull-left">{{session('activeNotificationCount')}}</span>
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">ارسال</a></li>
                    <li><a href="{{route('notification.index')}}">لیست</a></li>
                    <li><a href="{{route('notification.key')}}">پارامتر ها</a></li>
                    <li><a href="#">افزودن پارامتر</a></li>
                </ul>
            </li>

            <li class="nav-small-cap">--- پشتیبانی</li>
            <li><a href="#" class="waves-effect"><i class="zmdi zmdi-settings zmdi-hc-fw fa-fw"></i> <span
                            class="hide-menu"> تنظیمات </span></a></li>
            <li>
                <a href="{{ route('logout') }}" class="waves-effect"><i class="zmdi zmdi-power zmdi-hc-fw fa-fw"></i>
                    <span
                            class="hide-menu"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"> خروج </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
