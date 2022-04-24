<div class="page-header -i navbar navbar-fixed-top">
                    <!-- BEGIN HEADER INNER -->
                    <div class="page-header-inner">
                        <!-- BEGIN LOGO -->
                        <div class="page-logo">
                            <a href="/admin" style="margin-top: 15px">UTT</a>
                            <div class="menu-toggler sidebar-toggler">
                                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                            </div>
                        </div>
                        <!-- END LOGO -->
                        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        </a>
                        <!-- END RESPONSIVE MENU TOGGLER -->
                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <div class="top-menu">
                            <ul class="nav navbar-nav pull-right">
                                <li class="dropdown dropdown-user">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                   <!--  <img alt="" class="img-circle" src="http://library.dev/page/images/avatar3_small.jpg"/> -->
                                    <span class="username username-hide-on-mobile">
                                    <?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : '' ?> </span>
                                    <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '' ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-default">
                                        
                                        <li>
                                            <a href="<?php echo base_url('/thoat.php') ?>">
                                            <i class="icon-key"></i> Thoát </a>
                                        </li>
                                    </ul>
                                </li>
                             
                            </ul>
                        </div>
                        <!-- END TOP NAVIGATION MENU -->
                    </div>
                    <!-- END HEADER INNER -->
                </div>