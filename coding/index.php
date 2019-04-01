<?php

require_once ("classes/staff_login_class.php");
require_once ("classes/staffclass.php");
session_start();
if(isset($_POST['login-form-submit'])) {
    $error="";
    $id=$_POST['login-form-username'];
    $password=$_POST['login-form-password'];
    $directory= $_POST['login-form-directory'];
    $login=new staff_login_class($id,$directory,$password);
    if($login->login()){
        $_SESSION['name']=$login->getName();
        $_SESSION['surname']=$login->getSurname();
        $_SESSION['directory']=$login->getDirectory();
        $_SESSION['office']=$login->getOffice();
        $_SESSION['email']=$login->getEmail();
        $_SESSION['phone']=$login->getPhone();
        $_SESSION['id']=$login->getId();
        $_SESSION['password']=md5($password);
        echo "Success";
        if($_POST['login-form-directory']=="jobseeker")header("location: staff_jobseekers.php");
        if($_POST['login-form-directory']=="vacancy")header("location: staff_vacancy.php");
        if($_POST['login-form-directory']=="hr")header("location: staff_hr.php");
        if($_POST['login-form-directory']=="finance1")header("location: staff_finance.php");
        if($_POST['login-form-directory']=="finance2")header("location: staff_finance2.php");
        if($_POST['login-form-directory']=="info")header("location: staff_info.php");
        if($_POST['login-form-directory']=="informatizimi")header("location: staff_mediation.php");
        if($_POST['login-form-directory']=="trainings")header("location: staff_trainings.php");
        if($_POST['login-form-directory']=="juridik")header("location: staff_juridik.php");
        if($_POST['login-form-directory']=="admin")header("location: staff_administrator.php");
    }
    else $error="Recheck your credentials";
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />



    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Login-Staff Management System </title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap nopadding">

            <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background:linear-gradient(
      rgba(0, 0, 0, 0.7),
      rgba(0, 0, 0, 0.7)
    ), url('images/IMG_0560.jpg') center center no-repeat; background-size: cover;"></div>

            <div class="section nobg full-screen nopadding nomargin">
                <div class="container vertical-middle divcenter clearfix">

<!--                    <div class="row center">-->
<!--                        <a href="index.html"><img src="images/logo-dark.png" alt="Canvas Logo"></a>-->
<!--                    </div>-->

                    <div class="panel panel-default divcenter noradius noborder" style="max-height:500px; max-width: 400px; background-color: rgba(255,255,255,0.93);">
                        <div class="panel-body" style="padding: 40px;">
                            <form id="login-form" name="login-form" class="nobottommargin" action="#" method="post">
                                <h4>Staff Management System - Login</h4>

                                <div class="col_full">
                                    <?php if (isset($error)){?>
                                        <div class="style-msg errormsg">
                                            <div class="sb-msg"><i class="icon-remove"></i><strong>Oh snap! </strong><?php echo $error; ?></div>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="clear"></div>
                                <div class="col_full">
                                    <label for="login-form-username">ID card:</label>
                                        <input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" />

                                </div>

                                <div class="col_full">
                                <label for="login-form-directory">Select Directory</label>
                                <select name="login-form-directory" class="select-1 form-control" id="login-form-directory" style="width:100%;">
                                    <optgroup label="Drejtoria e Sherbimeve Mbeshtetese">
                                        <option value="jobseeker">Zyra e Regjistrimit te Punekerkuesve</option>
                                        <option value="vacancy">Zyra e Publikimit te Vendeve Vakante</option>
                                        <option value="hr">Burimet Njerezore</option>
                                    </optgroup>
                                    <optgroup label="Drejtoria e Financave">
                                        <option value="finance1">Zyra e Finances 1</option>
                                        <option value="finance2">Zyra e Finances 2</option>
                                    </optgroup>
                                    <optgroup label="Drejtoria e Programeve dhe Integrimit ne Tregun e Punes">
                                        <option value="trainings">Zyra e Ofrimit te Trajnimeve</option>
                                    </optgroup>
                                    <optgroup label="Drejtoria e Informacionit te Tregut te Punes dhe Informatizimit">
                                        <option value="info">Drejtoria e Informatizimit</option>
                                        <option value="informatizimi">Drejtoria e Informatizimit/Ndermjetesimi</option>
                                    </optgroup>
                                    <optgroup label="Sektori Juridik">
                                    <option value="juridik">Zyra e Keshillimit Juridik</option>
                                    </optgroup>
                                    <optgroup label="Administration">
                                        <option value="admin">Administrator</option>
                                    </optgroup>

                                </select>
                                </div>

                                <div class="col_full">
                                    <label for="login-form-password">Password:</label>
                                    <input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" />
                                </div>

                                <div class="col_full nobottommargin">
                                    <button class="button button-rounded button-reveal button-small button-border btn-block tright"
                                            id="login-form-submit" name="login-form-submit" value="login"><i class="icon-angle-right"></i><span>Login</span></button>
<!--                                    <a href="#" class="fright">Forgot Password?</a>-->
                                </div>

                            </form>

<!--                            <div class="line line-sm"></div>-->

                        </div>
                    </div>

                    <div class="row center dark"><small>Copyrights &copy; All Rights Reserved by Sherbimi Kombetar i Punesimit</small></div>

                </div>
            </div>

        </div>

    </section><!-- #content end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>

</body>
</html>