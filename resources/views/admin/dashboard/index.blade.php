@extends('admin.app')

@section('styles')
@stop

@section('content')

    <!-- .row -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">مجموع بازدید</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash"></div>
                    </li>
                    <li class="text-left"><i class="ti-arrow-up text-success"></i> <span
                                class="counter text-success">8659</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">مجموع بازدید صفحات</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-left"><i class="ti-arrow-up text-purple"></i> <span
                                class="counter text-purple">7469</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">بازدیدکنندگان</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash3"></div>
                    </li>
                    <li class="text-left"><i class="ti-arrow-up text-info"></i> <span
                                class="counter text-info">6011</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">نرخ رشد</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash4"></div>
                    </li>
                    <li class="text-left"><i class="ti-arrow-down text-danger"></i> <span
                                class="text-danger">18%</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <h3 class="box-title">فروش های 2017</h3>
                        <p class="m-t-30">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                            از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله</p>
                        <p>سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف
                            بهبود ابزارهای کاربردی می باشد</p>
                    </div>
                    <div class="col-md-8 col-sm-6 col-12">
                        <div id="morris-area-chart" style="height:250px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-lg-4 col-md-12 col-12">
            <div class="white-box">
                <h3 class="box-title">آب و هوا</h3>
                <div class="weather-box">
                    <div class="weather-top">
                        <h2 class="pull-right">دوشنبه <br>
                            <small>7 فروردین 1397</small>
                        </h2>
                        <div class="today_crnt pull-left">
                            <canvas class="sleet" width="44" height="44"></canvas>
                            <span>32<sup>°F</sup></span>
                        </div>
                    </div>
                    <div class="weather-info">
                        <h5 class="font-bold">اطلاعات آب و هوا</h5>
                        <div class="row">
                            <div class="col-6 p-l-10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="pull-right">باد</p>
                                        <p class="pull-left font-bold">16km/h</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="pull-right">طلوع خورشید</p>
                                        <p class="pull-left font-bold">05:20</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="pull-right">دما</p>
                                        <p class="pull-left font-bold" dir="ltr">32 <sup>°F</sup></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 p-r-10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="pull-right">غروب خورشید</p>
                                        <p class="pull-left font-bold">21:05</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="pull-right">فشار هوا </p>
                                        <p class="pull-left font-bold">22 in</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="weather-time">
                        <ul class="list-unstyled weather-days row">
                            <li class="col-4 col-sm-2"><span>سه‌شنبه</span>
                                <canvas class="sleet" width="30" height="30"></canvas>
                                <span>32<sup>°F</sup></span></li>
                            <li class="col-4 col-sm-2"><span>چهارشنبه</span>
                                <canvas class="clear-day" width="30" height="30"></canvas>
                                <span>34<sup>°F</sup></span></li>
                            <li class="col-4 col-sm-2"><span>پنج‌شنبه</span>
                                <canvas class="partly-cloudy-day" width="30" height="30"></canvas>
                                <span>35<sup>°F</sup></span></li>
                            <li class="col-4 col-sm-2"><span>جمعه</span>
                                <canvas class="cloudy" width="30" height="30"></canvas>
                                <span>34<sup>°F</sup></span></li>
                            <li class="col-4 col-sm-2"><span>شنبه</span>
                                <canvas class="snow" width="30" height="30"></canvas>
                                <span>30<sup>°F</sup></span></li>
                            <li class="col-4 col-sm-2"><span>یک‌شنبه</span>
                                <canvas class="wind" width="30" height="30"></canvas>
                                <span>26<sup>°F</sup></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="white-box">
                <h3 class="box-title">فعالیت کاربران</h3>
                <div class="steamline">
                    <div class="sl-item">
                        <div class="sl-right"><img class="img-circle" alt="user"
                                                   src="assets/images/users/genu.jpg"></div>
                        <div class="sl-left">
                            <div><a href="#">جان اسنو</a> <span class="sl-date">5 دقیقه قبل</span></div>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-right"><img class="img-circle" alt="user"
                                                   src="assets/images/users/ritesh.jpg"></div>
                        <div class="sl-left">
                            <div><a href="#">جان اسنو</a> <span class="sl-date">5 دقیقه قبل</span></div>
                            <p>با تولید سادگی نامفهوم</p>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-right"><img class="img-circle" alt="user"
                                                   src="assets/images/users/sonu.jpg"></div>
                        <div class="sl-left">
                            <div><a href="#">جان اسنو</a> <span class="sl-date">5 دقیقه قبل</span></div>
                            <p>صنعت چاپ و با استفاده از </p>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-right"><img class="img-circle" alt="user"
                                                   src="assets/images/users/ritesh.jpg"></div>
                        <div class="sl-left">
                            <div><a href="#">جان اسنو</a> <span class="sl-date">5 دقیقه قبل</span></div>
                            <p>چاپگرها و متون بلکه روزنامه</p>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-right"><img class="img-circle" alt="user"
                                                   src="assets/images/users/govinda.jpg"></div>
                        <div class="sl-left">
                            <div><a href="#">جان اسنو</a> <span class="sl-date">5 دقیقه قبل</span></div>
                            <p>برای شرایط فعلی تکنولوژی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="white-box">
                <h3 class="box-title">خروجی Feed</h3>
                <ul class="feeds">
                    <li>
                        <div class="bg-info"><i class="fa fa-bell-o text-white"></i></div>
                        You have 4 pending tasks. <span class="text-muted">Just Now</span></li>
                    <li>
                        <div class="bg-success"><i class="ti-server text-white"></i></div>
                        Server #1 overloaded.<span class="text-muted">2 Hours ago</span></li>
                    <li>
                        <div class="bg-warning"><i class="ti-shopping-cart text-white"></i></div>
                        New order received.<span class="text-muted">31 May</span></li>
                    <li>
                        <div class="bg-danger"><i class="ti-user text-white"></i></div>
                        New user registered.<span class="text-muted">30 May</span></li>
                    <li>
                        <div class="bg-inverse"><i class="fa fa-bell-o text-white"></i></div>
                        New Version just arrived. <span class="text-muted">27 May</span></li>
                    <li>
                        <div class="bg-purple"><i class="ti-settings text-white"></i></div>
                        You have 4 pending tasks. <span class="text-muted">27 May</span></li>
                </ul>
            </div>
        </div>
    </div>
    <!--/.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">وضعیت سفارش</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>فاکتور</th>
                            <th>کاربر</th>
                            <th>تاریخ سفارش</th>
                            <th>مقدار</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center">کد پیگیری</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link"> سفارش 53431</a></td>
                            <td>Steve N. Horton</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 22, 2014</span></td>
                            <td>$45.00</td>
                            <td class="text-center">
                                <div class="label label-table label-success">پرداخت شده</div>
                            </td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link"> سفارش 53432</a></td>
                            <td>Charles S Boyle</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 24, 2014</span></td>
                            <td>$245.30</td>
                            <td class="text-center">
                                <div class="label label-table label-info">ارسال شده</div>
                            </td>
                            <td class="text-center"><i class="fa fa-plane"></i> CGX0089734531</td>
                        </tr>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link"> سفارش 53433</a></td>
                            <td>Lucy Doe</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 24, 2014</span></td>
                            <td>$38.00</td>
                            <td class="text-center">
                                <div class="label label-table label-info">ارسال شده</div>
                            </td>
                            <td class="text-center"><i class="fa fa-plane"></i> CGX0089934571</td>
                        </tr>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link"> سفارش 53434</a></td>
                            <td>Teresa L. Doe</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 15, 2014</span></td>
                            <td>$77.99</td>
                            <td class="text-center">
                                <div class="label label-table label-info">ارسال شده</div>
                            </td>
                            <td class="text-center"><i class="fa fa-plane"></i> CGX0089734574</td>
                        </tr>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link"> سفارش 53435</a></td>
                            <td>Teresa L. Doe</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 12, 2014</span></td>
                            <td>$18.00</td>
                            <td class="text-center">
                                <div class="label label-table label-success">پرداخت شده</div>
                            </td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link">سفارش 53437</a></td>
                            <td>Charles S Boyle</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 17, 2014</span></td>
                            <td>$658.00</td>
                            <td class="text-center">
                                <div class="label label-table label-danger">مرجوعی</div>
                            </td>
                            <td class="text-center">-</td>
                        </tr>
                        <tr>
                            <td><a href="javascript:void(0)" class="btn-link">سفارش 536584</a></td>
                            <td>Scott S. Calabrese</td>
                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 19, 2014</span></td>
                            <td>$45.58</td>
                            <td class="text-center">
                                <div class="label label-table label-warning">پرداخت نشده</div>
                            </td>
                            <td class="text-center">-</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/.row -->

@stop

@section('scripts')
    <script src="assets/js/dashboard4.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/jquery.charts-sparkline.js"></script>
@stop
