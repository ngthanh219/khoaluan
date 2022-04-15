<?php 
    require_once __DIR__."/Connect.php";
    class Pagination extends Connect
    {
        private $total; // tong so ban ghi
        private $sql ; // cau lenh sql
        private $table ; // ten table
        private $page ; // tong so trang

        // private $totalPage;
        public function __construct()
        {
            parent::__construct();
        }

        public function pagination($table , $sql = '' , $start , $stop)
        {
            // if ( $sql == '')
            // {
            //     $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            // }
            $this->sql      = $sql ;
            $this->table    = $table ;
            // so trang 
            $page = ceil($this->totalPageRecou()/$stop);

            // gan so trang 
            $this->page = $page ;

            // vi tri lay 
            $start = ($this->getPage($start) - 1) * $stop;
            $set = '';
            //  neu ko ton tai $sql 
            if ($sql == '')
            {
                $sql = " SELECT * FROM {$table} LIMIT $start , $stop ";
                $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            }
            else
            {
                $sql .= " LIMIT $start , $stop ";
                $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            }

            $data = [];
            // _debug($sql);
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            $this->total = count($data);
            return $data;
        }


        // total table 
        public function totalPageRecou()
        {
            $query = $this->sql;
            $tables = $this->table ;
            // _debug($query);
            if ($query == '')
            {

                $sql = "SELECT count(id) as total FROM {$tables}";
                $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
                $row = mysqli_fetch_assoc($result);
                $this->total = $row['total'];
            }
            else
            {
                $result = mysqli_query($this->link,$query) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
                $data = [];
                // _debug($sql);
                if( $result)
                {
                    while ($num = mysqli_fetch_assoc($result))
                    {
                        $data[] = $num;
                    }
                }

                $this->total = count($data);
            }
            return $this->total ;
        }


        // get Page 
        public function getPage($page)
        {
            $page = isset($_GET[$page]) ? $_GET[$page] : 1;
            return $page ;
        }

        // lay so trang
        public function getTotalPage()
        {
            return $this->page ;
        }


        // render HTML ul li
        public function getListpage()
        {
            $page = intval($this->getTotalPage());
            $html = '<ul class="pagination">' ;
            

           
            if ($this->getPage('page') > 1)
            {
                $pre = intval($this->getPage('page')) - 1; 
                $html .= '<li><a href="?page='.$pre.'">Prev</a></li>';
                // echo "1212";
            }


            // them mot tham so neu ton tai biet check ! 
            // neu tong so ban ghi > 10 thi tien hanh   phan chia doan
            

            // tong so trang   
            // so trang hien tai
            $pageActive = $this->getPage("page");
    
            if ( intval($this->page) > 15 )
            {
               if (intval($pageActive)> 15)
                {
                    $html .= "<li><a href=?page=".(intval($pageActive) - 10).">...</a><li>";

                    for($i = $pageActive - 10 ; $i <= $pageActive + 10 ; $i ++ )
                    {                   
                        if($this->getPage('page') == $i)
                        {
                            $html .= "<li class='active'><a href='?page=".$i."'>" . $i ."</a></li>";
                        }
                        else
                        {
                            $html .= "<li><a href='?page=".$i."'>" . $i ."</a></li>";
                        }  
                    }
                    $html .= "<li><a href=?page=".(intval($pageActive) + 10).">...</a><li>";
                } 
                else
                {
                    for($i = 1; $i <= $pageActive + 10  ; $i ++ )
                    {                   
                        if($this->getPage('page') == $i)
                        {
                            $html .= "<li class='active'><a href='?page=".$i."'>" . $i ."</a></li>";
                        }
                        else
                        {
                            $html .= "<li><a href='?page=".$i."'>" . $i ."</a></li>";
                        }  
                    }
                    $html .= "<li><a href=?page=".(intval($pageActive) + 10).">...</a><li>";
                }
            }
            else 
            {
            
                 for($i = 1 ; $i <= $page ; $i ++ )
                {                   
                    if($this->getPage('page') == $i)
                    {
                        $html .= "<li class='active'><a href='?page=".$i."'>" . $i ."</a></li>";
                    }
                    else
                    {
                        $html .= "<li><a href='?page=".$i."'>" . $i ."</a></li>";
                    }  
                }
            }
           
            if ($this->getPage('page') + 1 <= $this->page)
            {
                $pre = intval($this->getPage('page')) + 1; 
                $html .= '<li><a href="?page='.$pre.'">Next</a></li>';
            }
            $html .= "</ul>" ;
            return $html;
        }
    }
?>
