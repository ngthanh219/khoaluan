<?php
    class Connect
    {
        protected $link;
        public function __construct()
        {
            // chuoi ket noi
            $this->link = mysqli_connect("127.0.0.1","root","root","doantotnghiep_quanlydoan","3307") or die ( ' Lỗi kết nối cơ sở dữ liệu  ' );
            // gan kieu du lieu
            mysqli_set_charset($this->link,"utf8");
        }
    }

?>