<?php
    // v2.0
    require_once __DIR__."/Connect.php";
    class DB extends Connect
    {

        protected $link;
        public function __construct()
        {
            parent::__construct();
        }
        /**
         * Hàm insert  ( Thêm mới )
         * có 2 tham số truyền vào
         * - tên bảng cần thêm mới
         * - Mảng gía trị vs các key tương ứng là  tên các trường trong CSDL
         * @param  [type] $table [description]
         * @param  array  $data  [description]
         * @return [type]        [description]
         */
        public function insert($table, array $data)
        {
            //code
            $sql = "INSERT INTO {$table} ";
            $columns = implode(',', array_keys($data));
            $values  = "";
            $sql .= '(' . $columns . ')';
            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $values .= "'". mysqli_real_escape_string($this->link,$value) ."',";
                } else {
                    $values .= mysqli_real_escape_string($this->link,$value) . ',';
                }
            }
            $values = substr($values, 0, -1);
            $sql .= " VALUES (" . $values . ')';
           // dd($sql);die;
            $check = mysqli_query($this->link, $sql);

            if ( ! $check )
            {
                echo $sql;
                db(" Insert thất bại ! Mời bạn kiểm tra dữ liệu truyền vào ");die;
            }

            return mysqli_insert_id($this->link);
        }


        /**
         * @param $table
         * @param $data
         * @param $conditions
         * @return int update thành công và thay đổi thì int = 1
         * ngược lại thì = 0
         * Hàm update ( Cập nhật )
         * hồm 3 tham số
         * - Đầu tiên là tên bảng cần update
         * - Thứ 2 là giá trị cần update ( có thể là mảng hoạc string )
         * - thứ 3 là điều kiện update ( có thẻ là mảng hoạc string )
         * VD $update = $db->update("test_email", "name = 'Phan s Trung Phu' , email = 'admin@gmail.com'  ", ("WHERE id = 1 and name = 'hehe'"));
         *
         *
         * $data = ['name' => "name "] , $condition = ['id' => $id]
         * $update = $db->update("test_email",$data, $condition)
         */

        public function update($table, $data, $conditions)
        {
            $sql = "UPDATE {$table}";
            $set = " SET ";
            $where = " WHERE ";

            if (is_array($data))
            {
                foreach($data as $field => $value) {
                    if(is_string($value)) {
                        $set .= $field .'='.'\''. mysqli_real_escape_string($this->link,($value)) .'\',';
                    } else {
                        $set .= $field .'='. mysqli_real_escape_string($this->link,($value)) . ',';
                    }
                }
                $set = substr($set, 0, -1);
            }
            else
            {
                $set .= $data ;
            }

            if (is_array($conditions))
            {
                foreach($conditions as $field => $value) {
                    if(is_string($value)) {
                        $where .= $field .'='.'\''. mysqli_real_escape_string($this->link,($value)) .'\' AND ';
                    } else {
                        $where .= $field .'='. mysqli_real_escape_string($this->link,($value)) . ' AND ';
                    }
                }
                $where = substr($where, 0, -5);
            }
            else
            {
                $where .= $conditions;
            }

            $sql .= $set . $where;

            $check = mysqli_query($this->link, $sql);
            if ( ! $check)
            {
                db(" Update thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
            else
            {
                return mysqli_affected_rows($this->link);
            }

        }


        /**
         * @param $table
         * @param $conditions
         * @return int
         * tham số truyền vào có thể là một số
         *  một chuỗi
         * hoạc một mảng
         *  Giá trị trả về > 0 = > delete thành công
         */
        public function delete ($table ,  $conditions )
        {
            $sql = "DELETE FROM {$table} WHERE " ;
            if (is_int($conditions))
            {
                $conditions = (int) $conditions;
                $sql .= " id = $conditions ";
            }
            else if (is_array($conditions))
            {
                foreach($conditions as $field => $value) {
                    if(is_string($value)) {
                        $sql .= $field .'='.'\''. mysqli_real_escape_string($this->link,($value)) .'\' AND ';
                    } else {
                        $sql .= $field .'='. mysqli_real_escape_string($this->link,($value)) . ' AND ';
                    }
                }
                $sql = substr($sql, 0, -5);
            }
            else
            {
                $sql .= $conditions ;
            }

            $check = mysqli_query($this->link,$sql);
            if ( ! $check)
            {
                db(" Xóa thất ! bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
            else
            {
                return mysqli_affected_rows($this->link);
            }

        }

        /**
         * @param $table
         * @param $conditions
         * @return int
         *  lấy một bản ghi hoạc lấy theo ID
         *  giá trị trả về chỉ là 1 bản ghi nên cần xem xét khi dùng hàm này
         *  nếu truyền vào tên bảng và một số thì mặc định nó sẽ queyry theo id
         *  còn truyền vào chuỗi thì nó sẽ  lấy theo điều kiện
         */
        public function fetchOne($table , $conditions )
        {
            $sql = "SELECT * FROM {$table} " ;

            if ( is_int($conditions))
            {
                $sql .= " WHERE id = $conditions ";
            }
            else
            {
                $sql .= " WHERE " .$conditions ;
            }

            $check = mysqli_query($this->link,$sql);
            if ( ! $check)
            {
                db(" Truy vấn thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
            else
            {
                return mysqli_fetch_assoc($check);
            }

        }


        /**
         * @param $table
         * @param string $get
         * @param $conditions
         * @return array
         *  tham số đầu tiên là tên bảng
         * thứ 2 là muốn lấy cái gì
         * điều kiên
         */
        public function query($table, $get = '*' , $conditions )
        {
            $sql = "SELECT {$get} FROM {$table} WHERE 1 AND " ;
            $where = '';
            if (is_array($conditions))
            {
                foreach($conditions as $field => $value) {
                    if(is_string($value)) {
                        $where .= $field .'='.'\''. mysqli_real_escape_string($this->link,($value)) .'\' AND ';
                    } else {
                        $where .= $field .'='. mysqli_real_escape_string($this->link,($value)) . ' AND ';
                    }
                }
                $where = substr($where, 0, -5);
                $sql .= $where;
            }
            else
            {
                $sql = substr($sql, 0, -5);
                $sql .= $conditions ;
            }
            $result = mysqli_query($this->link,$sql);
            if ( ! $result)
            {
                db(" Truy vấn thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
            // var_dump($sql);die;
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;

        }

        /**
         * @param $sql
         * @return array
         *  truyền vào câu truy vấn bình thường
         */
        public function fetchsql( $sql )
        {
            // var_dump($sql);die;
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $data = [];
            if ( ! $result )
            {
                db(" Truy vấn thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");
            }
            else
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }
        public function countTable($table)
        {
            $sql = "SELECT id FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

    }

?>