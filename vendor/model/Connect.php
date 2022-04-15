<?php
    class Connect
    {
        protected $link;
        public function __construct()
        {
            // chuoi ket noi
            // $this->link = mysqli_connect("127.0.0.1","root","root","doantotnghiep_phpthuan_qldoan","8889") or die ( ' Lỗi kết nối cơ sở dữ liệu  ' );
            $this->link = mysqli_connect("127.0.0.1","root","","doantotnghiep_phpthuan_qldoan","3306") or die ( ' Lỗi kết nối cơ sở dữ liệu  ' );

            // gan kieu du lieu
            mysqli_set_charset($this->link,"utf8");
        }
    }

?>