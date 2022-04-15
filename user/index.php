<?php
    require_once  __DIR__."/../autoload.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $masinhvien = getValue("masinhvien","POST","");
        $pass  = getValue("password","POST","");

        $check = $db->fetchsql(" SELECT * FROM tbl_sinhvien WHERE masinhvien = '".$masinhvien."'  AND matkhau = '".$pass."' ");

        if (count($check) > 0)
        {
            $_SESSION['user_id']   = $check[0]['id'];
            $_SESSION['user_name'] = $check[0]['tensinhvien'];
            $_SESSION['user_id_msv'] = $check[0]['masinhvien'];
            $_SESSION['check_login'] = $check[0]['tensinhvien'];
            $_SESSION['success'] =  " Đăng nhập thành công ";
           
            header("Location: ".base_url("/admin"));
        }
        else
        {
            $_SESSION['error'] = " Sai thong tin dang nhap ";
        }
    }
?>
<style type="text/css">
    form {
    border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
    opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
    width: 40%;
    border-radius: 50%;
}

/* Add padding to containers */
.container {
    padding: 16px;
}

/* The "Forgot password" text */
span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
}
#main
{
    width: 40%;margin: 30px auto;
}
</style>
<div id="main">
    <form action="" action="" method="POST">
        <div class="container">
            <label><b>Mã sinh viên</b></label>
            <input type="text" placeholder="122101212" name="masinhvien" required>
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <button type="submit">Login</button>
            <!-- <input type="checkbox" checked="checked"> Remember me -->
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>
