<?php
    require_once  __DIR__."/../../autoload.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = getValue("email","POST","");
        $pass  = getValue("password","POST","");

        $check = $db->fetchsql(" SELECT * FROM tbl_giaovien WHERE email = '".$email."'  AND matkhau = '".$pass."' ");

        if (count($check) > 0)
        {
            $_SESSION['admin_id']   = $check[0]['id'];
            $_SESSION['table'] = "tbl_giaovien";
            $_SESSION['admin_name'] = $check[0]['tengiaovien'];
            $_SESSION['check_login'] = $check[0]['tengiaovien'];
            $_SESSION['success'] =  " Đăng nhập thành công ";
           
            header("Location: ".base_url("/admin/doan/do-an-cua-ban.php"));
        }
        else
        {
            $_SESSION['error'] = " Sai thong tin dang nhap ";
        }
    }
?>

<!DOCTYPE html>
    <html >
    <head>
        <meta charset="UTF-8">
        <title>  Giảng viên  </title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <style>
        /*@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);*/

        body {
            background: #456;
            font-family: 'Open Sans', sans-serif;
        }

        .login {
            width: 400px;
            margin: 80px auto;
            font-size: 16px;

        }

        /* Reset top and bottom margins from certain elements */
        .login-header,
        .login p {
            margin-top: 0;
            margin-bottom: 0;
        }

        /* The triangle form is achieved by a CSS hack */
        .login-triangle {
            width: 0;
            margin-right: auto;
            margin-left: auto;
            border: 12px solid transparent;
            border-bottom-color: #28d;
        }

        .login-header {
            background: #28d;
            padding: 20px;
            font-size: 1.4em;
            font-weight: normal;
            text-align: center;
            text-transform: uppercase;
            color: #fff;
        }

        .login-container {
            background: #ebebeb;
            padding: 12px;
        }

        /* Every row inside .login-container is defined with p tags */
        .login p {
            padding: 12px;
        }

        .login input {
            box-sizing: border-box;
            display: block;
            width: 100%;
            border-width: 1px;
            border-style: solid;
            padding: 16px;
            outline: 0;
            font-family: inherit;
            font-size: 0.95em;
        }

        .login input[type="email"],
        .login input[type="password"] {
            background: #fff;
            border-color: #bbb;
            color: #555;
        }

        /* Text fields' focus effect */
        .login input[type="email"]:focus,
        .login input[type="password"]:focus {
            border-color: #888;
        }

        .login input[type="submit"] {
            background: #28d;
            border-color: transparent;
            color: #fff;
            cursor: pointer;
        }

        .login input[type="submit"]:hover {
            background: #17c;
        }

        /* Buttons' focus effect */
        .login input[type="submit"]:focus {
            border-color: #05a;
        }
    </style>
    <div class="login">
        <div class="login-triangle"></div>

        <h2 class="login-header"> Quản trị giảng viên </h2>

        <form class="login-container" action="" method="POST">
            <?php if(isset($_SESSION['error'])) : ?>
                <p class="text-danger" style="color: red"><?php echo $_SESSION['error'] ; unset($_SESSION['error']) ?></p>
            <?php endif; ?>

            <p><input type="email" placeholder="Email" name="email" required></p>
            <p><input type="password" placeholder="Password" name="password" required></p>
            <p><input type="submit" value=" Đăng nhập "></p>
        </form>
    </div>
    <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
    </body>
</html>
