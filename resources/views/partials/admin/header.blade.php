<nav class="navbar navbar-default navbar-static-top" role="navigation"
     style="margin-bottom: 0; background-color: #fcfcfc;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="."><img src="{{asset('img/logo.jpg')}}" style="margin-left: 15px;" width="150"
                         alt="CHÀO MỪNG ĐẾN VỚI TRUNG TÂM PHỤC HỒI CHỨC NĂNG VĨNH ĐỨC"></a>
        <div class="scroll-left" style="display: inline-block;margin-left: 300px;color: #00a859;">
            <marquee id="marquee" direction="left" scrollamount="3" loop="true" scrolldelay="6">
                CHÀO MỪNG ĐẾN VỚI TRUNG TÂM PHỤC HỒI CHỨC NĂNG VĨNH ĐỨC
            </marquee>
        </div>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a href="{{ asset('auth/logout') }}">
                Đăng xuất
                <i class="fa fa-user fa-fw"></i>
            </a>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="javascript:;"><i class="fa fa-dashboard fa-fw"></i> Trang chủ</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Quản lý<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="javascript:;">Chức vụ</a>
                        </li>
                        @if(Auth::user()->roleId == 1)
                            <li>
                                <a href="javascript:;">Người dùng</a>
                            </li>
                        @else

                        @endif

                        <li>
                            <a href="javascript:;">Bệnh nhân</a>
                        </li>
                        <li>
                            <a href="javascript:;">Điều trị viên</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="javascript:;"><i class="fa fa-table fa-fw"></i> Danh mục<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="javascript:;">Gói</a>
                        </li>
                        <li>
                            <a href="javascript:;">Vùng điều trị</a>
                        </li>
                        <li>
                            <a href="javascript:;">Tỉnh thành</a>
                        </li>
                        <li>
                            <a href="javascript:;">Độ tuổi</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"><i class="fa fa-book fa-fw"></i> Hồ sơ bệnh án<span></span></a>
                </li>
                @if(Auth::user()->roleId == 1 || Auth::user()->positionId == 2)
                    <li>
                        <a href="javascript:;"><i class="fa fa-edit fa-fw"></i> Chẩn đoán</a>
                    </li>
                @else

                @endif
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Khảo sát<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="javascript:;"> <i class="fa fa-wrench fa-fw"></i>Tiến triển bệnh<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                @if(Auth::user()->roleId == 1 || Auth::user()->positionId == 3 )
                                    <li>
                                        <a href="javascript:;">Điều trị chuyên môn</a>
                                    </li>
                                @else

                                @endif
                                @if(Auth::user()->roleId == 1 || Auth::user()->positionId == 2)
                                    <li>
                                        <a href="javascript:;">Phác đồ điều trị</a>
                                    </li>
                                @else

                                @endif
                                <li>
                                    <a href="javascript:;">Thống kê bệnh nhân</a>
                                </li>
                                <li>
                                    <a href="javascript:;">Thống kê chuyên viên</a>
                                </li>
                            </ul>
                        <li>
                            <a href="javascript:;"><i class="fa fa-edit fa-fw"></i> Ý kiến bệnh nhân<span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="javascript:;">Tìm kiếm phác đồ</a>
                                </li>
                                <li>
                                    <a href="javascript:;">Thông tin khảo sát ý kiến bệnh nhân</a>
                                </li>
                                <li>
                                    <a href="javascript:;">Thống kê và xem danh sách khảo sát</a>
                                </li>
                            </ul>
                        </li>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<style>
    @media (max-width: 768px) {
        #marquee {
            display: none;
        }
    }
</style>