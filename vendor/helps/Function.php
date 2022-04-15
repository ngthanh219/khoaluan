<?php
    /**
     *  khai bao url
     */
    if ( ! function_exists("base_url"))
    {
        function base_url( $url = '' )
        {
        	return  'http://localhost/quanlydoan'. $url;
            return "http://".$_SERVER['SERVER_NAME'] . $url ;
        }
    }

    function redirect($url = '')
    {
        header("Location: ".base_url($url)) ; exit();
    }
    if ( ! function_exists( 'dd' ))
    {
        /**
         * @param $data
         */
        function dd( $data ) {
            echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
            echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';
            $debug_backtrace = debug_backtrace();
            $debug = array_shift($debug_backtrace);
            echo '<div>File: ' . $debug['file'] . '</div>';
            echo '<div>Line: ' . $debug['line'] . '</div>';
            if(is_array($data) || is_object($data)) {
                print_r($data);
            }
            else {
                var_dump($data);
            }
            echo '</pre>';
            die;
        }
    }
    function ColorFind($string,$fild)
    {
        if($string != '')
        {
            return str_replace($string,"<span style='color:red;font-size:14px'>".$string."</span>",$fild);
        }
        else
        {
            return $fild;
        }
    }

    if ( ! function_exists( 'db' ))
    {
        /**
         * @param $data
         * echo ra thông báo lỗi ở SQL
         */
        function db( $data ) {
            echo '<pre style="background:#000; color: #fff; width: 90%; overflow: auto;border:1px solid #d6e9c6;padding-top: 10px;padding-bottom:10px;padding-left:5px;padding-right:5px;margin:0 auto;">';
            $debug_backtrace = debug_backtrace();
            $debug = array_shift($debug_backtrace);
            echo '<div>Line: ' . $debug['line'] . '</div>';
            if(is_array($data) || is_object($data)) {
                print_r($data);
            }
            else {
                var_dump($data);
            }
            echo '</pre>';
        }
    }


    if ( ! function_exists("renderAction"))
    {
        /**
         *  them  cac action them sua xoa
         */
        function renderAction()
        {
            return '<div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"><i class="fa fa-cloud"></i> Lưu </button>
                                <button type="reset" class="btn green"><i class="fa fa-refresh"></i> Làm mới </button>
                                <a href="index.php" class="btn red"> <i class="icon-logout"></i> Trở về </a>
                            </div>
                        </div>
                    </div>';
        }
    }


    if ( !  function_exists('getValue'))
    {
        /**
         * @param $value
         * @param $method
         * @param $default
         * @return string
         */
        function getValue( $value , $method , $default )
        {
            $data ='';
            if ($method == "POST")
            {
                $data = isset($_POST[$value]) ? trim($_POST[$value]) :  $default;
            }
            else
            {
                $data = isset($_GET[$value]) ? trim($_GET[$value]) :  $default;
            }
            return $data;
        }

    }
    if (!  function_exists("to_slug"))
    {
        function to_slug($str) {
            $str = trim(mb_strtolower($str));
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
            $str = preg_replace('/(đ)/', 'd', $str);
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
            $str = preg_replace('/([\s]+)/', '-', $str);
            return $str;
        }
    }
    if ( ! function_exists("recursive"))
    {
        function recursive($listCategory ,$parents = 0 ,$level = 1 ,&$CategoryListSort)
        {
            if(count($listCategory) > 0 )
            {
                foreach ($listCategory as $key => $value) {
                    if($value['parent_id']  == $parents)
                    {
                        $value['level'] = $level;
                        $CategoryListSort[] = $value;
                        unset($listCategory[$key]);
                        $newparents = $value['id'];

                        recursive($listCategory , $newparents ,$level + 1 , $CategoryListSort);
                    }
                }
            }
        }
    }
    if ( ! function_exists("cutstring"))
    {
        /**
         * @param $string
         * @param $number
         * @return string
         */
        function cutstring($string,$number)
        {
            $stringCut = substr($string, 0,$number);
            return substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
        }
    }

    if ( ! function_exists('issetType'))
    {
        /**
         * @param $errors
         * @return string
         * show loi
         */
        function issetType($errors)
        {
            return isset($errors) && $errors != null ? $errors : '';
        }
    }

    if ( ! function_exists('showErrors'))
    {
        /**
         * @param $errors
         * @return string
         * show loi
         */
        function showErrors($errors)
        {
            if(isset($errors) && ($errors) != '')
            {
                return ' <span class="help-block" style="margin-bottom: -10px">'.$errors.'</span>' ;
            }
            else
            {
                return " ko co loi ";
            }
        }
    }


    function old($value = '')
    {
        echo isset($_POST[$value]) ? $_POST[$value] : '';
    }

?>