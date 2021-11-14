<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part"><a class="logo" href="index.html"><b><img src="{{asset('assets/images/eliteadmin-logo.png')}}" alt="home"></b><span class="hidden-xs"><img src="{{asset('assets/images/eliteadmin-text.png')}}" alt="home"></span></a></div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-right-circle ti-menu"></i></a></li>
            <li>
                <form role="search" class="app-search hidden-xs">
                    <input type="text" placeholder="جستجو ..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-left">

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <img src="{{asset('assets/images/users/varun.jpg')}}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{getUserFullName()}}</b> </a>
                <ul class="dropdown-menu dropdown-user scale-up">
                    <li><a href="#"><i class="ti-user"></i> پروفایل من</a></li>
                    <li role="separator" class="divider"> </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> خروج</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- .Megamenu -->
            <li class="mega-dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><span class="hidden-xs"></span> <i class="icon-menu"></i></a>
                <ul class="dropdown-menu mega-dropdown-menu animated bounceInDown">
                    <li class="col-sm-12 m-t-40 demo-box">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="white-box text-center bg-purple"><a href="#" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br>گزینه نمایشی 1</a></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="white-box text-center bg-success"><a href="#" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br>گزینه نمایشی 2</a></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="white-box text-center bg-info"><a href="#" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br>گزینه نمایشی 3</a></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="white-box text-center bg-inverse"><a href="#" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br>گزینه نمایشی 4</a></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="white-box text-center bg-warning"><a href="#" target="_blank" class="text-white"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i><br>گزینه نمایشی 5</a></div>
                            </div>
                            <div class="col-sm-2">
                                <div class="white-box text-center bg-danger"><a href="#" target="_blank" class="text-white"><i class="linea-icon linea-ecommerce fa-fw" data-icon="d"></i><br>خرید قالب</a></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- /.Megamenu -->
            <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
