<div class="page-header">
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.html">
                            <img src="../assets/layouts/layout3/img/logo-default.jpg" alt="logo" class="logo-default">
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                                <li class="dropdown dropdown-user dropdown-dark">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <img alt="" class="img-circle" src="../assets/layouts/layout3/img/avatar9.jpg">
                                        <span class="username username-hide-mobile">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        <li>
                                            <a href="page_user_profile_1.html">
                                                <i class="icon-user"></i> My Profile </a>
                                        </li>
                                        <li>
                                            <a href="app_calendar.html">
                                                <i class="icon-calendar"></i> My Calendar </a>
                                        </li>
                                        <li>
                                            <a href="app_inbox.html">
                                                <i class="icon-envelope-open"></i> My Inbox
                                                <span class="badge badge-danger"> 3 </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="app_todo_2.html">
                                                <i class="icon-rocket"></i> My Tasks
                                                <span class="badge badge-success"> 7 </span>
                                            </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="page_user_lock_1.html">
                                                <i class="icon-lock"></i> Lock Screen </a>
                                        </li>
                                        <li>
                                            <a href="page_user_login_1.html">
                                                <i class="icon-key"></i> Log Out </a>
                                        </li>
                                    </ul>
                                </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <form class="search-form" action="page_general_search.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN MEGA MENU -->
                    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                    <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                    <div class="hor-menu">
                        <ul class="nav navbar-nav">
                            <li class="menu-dropdown classic-menu-dropdown active">
                                <a href="javascript:;"> Dashboard
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class=" active">
                                        <a href="index.html" class="nav-link  active">
                                            <i class="icon-bar-chart"></i> Default Dashboard
                                            <span class="badge badge-success">1</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-dropdown classic-menu-dropdown ">
                                <a href="javascript:;"> Layouts
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class=" ">
                                        <a href="layout_mega_menu_light.html" class="nav-link  "> Light Mega Menu </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-dropdown classic-menu-dropdown ">
                                <a href="javascript:;"> More
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-settings"></i> Form Stuff
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="form_controls.html" class="nav-link "> Bootstrap Form
                                                    <br>Controls </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-briefcase"></i> Tables
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu ">
                                                <a href="javascript:;" class="nav-link nav-toggle"> Static Tables
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="">
                                                        <a href="table_static_basic.html" class="nav-link "> Basic Tables </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="table_static_responsive.html" class="nav-link "> Responsive Tables </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu ">
                                                <a href="javascript:;" class="nav-link nav-toggle"> Datatables
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="">
                                                        <a href="table_datatables_managed.html" class="nav-link "> Managed Datatables </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="?p=" class="nav-link nav-toggle ">
                                            <i class="icon-wallet"></i> Portlets
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="portlet_boxed.html" class="nav-link "> Boxed Portlets </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="?p=" class="nav-link nav-toggle ">
                                            <i class="icon-settings"></i> Elements
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="elements_steps.html" class="nav-link "> Steps </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-bar-chart"></i> Charts
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="charts_amcharts.html" class="nav-link "> amChart </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-dropdown classic-menu-dropdown ">
                                <a href="javascript:;">
                                    <i class="icon-briefcase"></i> Pages
                                    <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-basket"></i> eCommerce
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="ecommerce_index.html" class="nav-link ">
                                                    <i class="icon-home"></i> Dashboard </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-docs"></i> Apps
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="app_todo.html" class="nav-link ">
                                                    <i class="icon-clock"></i> Todo 1 </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-user"></i> User
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="page_user_profile_1.html" class="nav-link ">
                                                    <i class="icon-user"></i> Profile 1 </a>
                                            </li>
                                            <li class=" ">
                                                <a href="page_user_profile_1_account.html" class="nav-link ">
                                                    <i class="icon-user-female"></i> Profile 1 Account </a>
                                            </li>
                                            <li class=" ">
                                                <a href="page_user_profile_1_help.html" class="nav-link ">
                                                    <i class="icon-user-following"></i> Profile 1 Help </a>
                                            </li>
                                            <li class=" ">
                                                <a href="page_user_profile_2.html" class="nav-link ">
                                                    <i class="icon-users"></i> Profile 2 </a>
                                            </li>
                                            <li class="dropdown-submenu ">
                                                <a href="javascript:;" class="nav-link nav-toggle">
                                                    <i class="icon-notebook"></i> Login
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="">
                                                        <a href="page_user_login_1.html" class="nav-link " target="_blank"> Login Page 1 </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class=" ">
                                                <a href="page_user_lock_1.html" class="nav-link " target="_blank">
                                                    <i class="icon-lock"></i> Lock Screen 1 </a>
                                            </li>
                                            <li class=" ">
                                                <a href="page_user_lock_2.html" class="nav-link " target="_blank">
                                                    <i class="icon-lock-open"></i> Lock Screen 2 </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-social-dribbble"></i> General
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="page_general_about.html" class="nav-link ">
                                                    <i class="icon-info"></i> About </a>
                                            </li>
                                            <li class=" ">
                                                <a href="page_general_contact.html" class="nav-link ">
                                                    <i class="icon-call-end"></i> Contact </a>
                                            </li>
                                            <li class="dropdown-submenu ">
                                                <a href="javascript:;" class="nav-link nav-toggle">
                                                    <i class="icon-notebook"></i> Portfolio
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="">
                                                        <a href="page_general_portfolio_1.html" class="nav-link "> Portfolio 1 </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu ">
                                                <a href="javascript:;" class="nav-link nav-toggle">
                                                    <i class="icon-magnifier"></i> Search
                                                    <span class="arrow"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="">
                                                        <a href="page_general_search.html" class="nav-link "> Search 1 </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class=" ">
                                                <a href="page_general_pricing.html" class="nav-link ">
                                                    <i class="icon-tag"></i> Pricing </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu ">
                                        <a href="javascript:;" class="nav-link nav-toggle ">
                                            <i class="icon-settings"></i> System
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class=" ">
                                                <a href="page_system_coming_soon.html" class="nav-link " target="_blank"> Coming Soon </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>