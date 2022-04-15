<div class="page-sidebar-wrapper">
                
        <div class="page-sidebar navbar-collapse collapse">
           
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <?php if (isset($_SESSION['admin_id'])) :?>
                <li class="start  open">
                    <a href="/admin/">
                    <i class="icon-home"></i>
                    <span class="title"> Trang Chủ  </span>
                    </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'khoa' ? 'open active' : '' ?>">

                    <a href="<?php echo base_url('/admin/khoa') ?>"> Quản lý khoa  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'chuyennganh' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/chuyennganh') ?>"> Quản lý chuyên ngành  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'hedaotao' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/hedaotao') ?>"> Quản lý Hệ đào tạo  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'nienkhoa' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/nienkhoa') ?>"> Quản lý Niên khóa   </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'lop' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/lop') ?>"> Quản lý Lớp  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'giaovien' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/giaovien') ?>"> Quản lý Giáo viên  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'hoidong' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/hoidong') ?>"> Quản lý Hội đồng  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'sinhvien' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/sinhvien') ?>"> Quản lý sinh viên  </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'doan' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/doan') ?>"> Danh sách đồ án   </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'quanly' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/quanly') ?>"> Quản lý    </a>
                </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])) :?>
                <li class="<?php echo isset($modules) && $modules == 'select-doan' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/select-doan') ?>"> Chọn đồ án   </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'doan' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/doan') ?>"> Danh sách đồ án   </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'info' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/info') ?>"> Quản lý thông tin    </a>
                </li>
                <li class="<?php echo isset($modules) && $modules == 'giaovien' ? 'open active' : '' ?>">
                    <a href="<?php echo base_url('/admin/giaovien') ?>"> Quản lý Giáo viên  </a>
                </li>
            <?php endif ?>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>