<?php
session_start();
require_once("classes/workingStaff.php");
require_once("classes/crud_class.php");

if (isset($_SESSION['name'])&& isset($_SESSION['surname'])&& isset($_SESSION['id'])&& isset($_SESSION['directory']))
{
$name=$_SESSION['name'];
$surname=$_SESSION['surname'];
$directory=$_SESSION['directory'];
$id=$_SESSION['id'];
$salaryList=new crud_class();
$results=$salaryList->read();
$result=$salaryList->read();

if(isset($_POST['register-form-submit'])) {
    $pid=$_POST['userid'];
    $salaryList->insertSalary($_POST['register-form-base'],$pid);
    $error=$salaryList->getError();
}

if(isset($_POST['submit-salary'])) {
    $salaryList->calculateSalary();
    $error=$salaryList->getError();
    header("Refresh:2");
}


if(isset($_POST['print-salary'])) {
    $_SESSION['name']=$name;
    $_SESSION['surname']=$surname;
    header("location:generate_salaries.php");
}

if(isset($_POST['confirm-salary'])) {
    $salaryList->confirmSalary();
    $error=$salaryList->getError();
    header("Refresh:2");
}
    if(isset($_POST['settings-form-confirm']) && isset($_POST['settings-form-confirm']) && isset($_POST['settings-form-old'] )
        && isset($_POST['settings-form-new'])&& isset($_POST['settings-form-reenter']) ){
        echo ("here");
        if(md5($_POST['settings-form-old'])==$_SESSION['password']){
            echo ("here1");
            if($_POST['settings-form-new']==$_POST['settings-form-reenter']){
                echo ("here2");
                $pass=$_POST['settings-form-reenter'];
                $salaryList->updatePassword($id,$pass);
                $_SESSION['error']=$salaryList->getError();
                header("location:index.php");
            }
        }
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

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Profile | Staff</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <header id="header" class="full-header">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="index.php" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="Canvas Logo"></a>
                    <a href="index.php" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="images/logo.png" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div id="top-account" class="dropdown">
                    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-user"></i><i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Profile</a></li>
                        <!--							<li><a href="#">List of all workers <span class="badge">5</span></a></li>-->
                        <!--							<li><a href="#">Add new workers</a></li>-->
                        <!--							<li><a href="#">Confirm attendance</a></li>-->
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Logout <i class="icon-signout"></i></a></li>
                    </ul>
                </div>

                <!-- Primary Navigation
                ============================================= -->


            </div>

        </div>

    </header><!-- #header end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="row clearfix">

                    <div class="col-sm-9">

                        <img src="images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">

                        <div class="heading-block noborder">
                            <h3><?php echo $name." ".$surname;?></h3>
                            <span><?php echo $id;?></span>
                        </div>

                        <div class="clear"></div>

                        <div class="row clearfix">

                            <div class="col-md-12">

                                <div class="tabs tabs-alt clearfix" id="tabs-profile">

                                    <ul class="tab-nav clearfix">
                                        <li><a href="#tab-profile"><i class="icon-user"></i> Profile</a></li>
                                        <li><a href="#tab-base"><i class="icon-plus"></i> Base Salary</a></li>
                                        <li><a href="#tab-salary"><i class="icon-money"></i>Salary</a></li>
                                        <li><a href="#tab-confirm"><i class="icon-check"></i> Confirm Salaries</a></li>
                                        <li><a href="#tab-information"><i class="icon-info-sign"></i> Information</a></li>
                                        <li><a href="#tab-settings"><i class="icon-settings"></i> Settings</a></li>
                                    </ul>

                                    <div class="tab-container">

                                        <div class="tab-content clearfix" id="tab-profile">

                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                <li><i class="icon-user"></i> Drejtoria e Financave</li>
                                                <li><i class="icon-folder-open"></i> Profile</li>
                                            </ul>
                                            <div class="clear"></div>

                                            <div class="heading-block noborder">
                                                <span><i class="icon-credit-cards"></i> <?php echo $_SESSION['id']?> </span>
                                                <span><i class="icon-location"></i> <?php echo $_SESSION['office']?> </span>
                                                <span><i class="icon-email3"></i> <?php echo $_SESSION['email']?> </span>
                                                <span><i class="icon-phone"></i> <?php echo $_SESSION['phone']?> </span>
                                            </div>
                                            </div>
                                        <div class="tab-content clearfix" id="tab-base">
                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                <li><i class="icon-user"></i> Drejtoria e Financave</li>
                                                <li><i class="icon-folder-open"></i>Insert Base Salary</li>
                                            </ul>
                                            <div class="content-wrap">

                                                <div class="container clearfix">

                                                    <form action="#" method="post">




                                                        <div class="clear"></div>
                                                        <div class="col_one_third">
                                                            <label for="userid">ID & Position</label>
                                                            <select id="userid" name="userid" class="sm-form-control required">
                                                                <?php
                                                                while($rows = $results->fetch_assoc()) {
                                                                    ?>
                                                                    <option value="<?php echo $rows['id'];?>"><?php echo $rows['id']."\t".$rows['position'];?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="clear"></div>

                                                        <div class="col_one_third">
                                                            <label for="register-form-base">Base Salary<small>*</small></label>
                                                            <input type="number" min=0 step=5000 id="register-form-base" name="register-form-base" value="" class="sm-form-control required" />
                                                        </div>

                                                        <div class="clear"></div>
                                                        <div class="col_one_third">
                                                            <button class="button button-rounded button-reveal button-border button-red btn-lg btn-block" type="submit" id="register-form-submit" name="register-form-submit" value="submit">Insert Base Salary <i class="icon-circle-arrow-right"></i></button>
                                                        </div>

                                                    </form>


                                                </div>

                                            </div>


                                        </div>
                                        <div class="tab-content clearfix" id="tab-salary">
                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                <li><i class="icon-user"></i> Drejtoria e Financave</li>
                                                <li><i class="icon-folder-open"></i> Calculation of Salary</li>
                                            </ul>

                                            <div class="col_full">
                                                <div class="alert alert-danger nobottommargin">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <i class="icon-warning-sign"></i><strong>Warning! </strong>You can not calculate the salaries if HR didn't submit the attendance list.
                                                </div>
                                            </div>

                                                    <div class="table-responsive">
                                                        <table id="datatable1" class="table table-hover " width="70%">
                                                            <thead>
                                                            <tr>
                                                                <th>Name Surname</th>
                                                                <th>Position</th>
                                                                <th>Working Days</th>
                                                                <th>Salary</th>
                                                            </tr>
                                                            </thead>
                                                            <tfoot>
                                                            <tr>
                                                                <th>Name Surname</th>
                                                                <th>Position</th>
                                                                <th>Working Days</th>
                                                                <th>Salary</th>
                                                            </tr>
                                                            </tfoot>
                                                            <tbody>
                                                            <?php
                                                            $bool="1";
                                                            while($row = $result->fetch_assoc()) {
                                                                if($row['confirmation']==0)$bool='0';
                                                                else{
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['name']." ".$row['surname'] ?></td>
                                                                    <td><?php echo $row['position']?></td>
                                                                    <td><?php echo $row['previouswdays']?></td>
                                                                    <td><?php echo "$ ".$row['salary']?></td>
                                                                </tr>
                                                            <?php }} ?>
                                                            </tbody>
                                                        </table>

                                                        <div class="clear"></div>
                                                        <form method="post">
                                                        <div class="col_one_third">
                                                            <button class="button button-rounded button-reveal button-border button-red btn-lg btn-block tright" type="submit" id="submit-salary" name="submit-salary"
                                                                    <?php if ($bool==0) echo "disabled";?> value="submit">
                                                                Calculate Salary<i class="icon-arrow-right"></i></button>
                                                        </div>
                                                        </form>
                                            </div>
                                        </div>
                                        <div class="tab-content clearfix" id="tab-confirm">


                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                <li><i class="icon-user"></i> Drejtoria e Financave</li>
                                                <li><i class="icon-folder-open"></i> Confirm Salaries</li>
                                            </ul>

                                            <div class="content-wrap">
                                                <div class="col_full">
                                                    <div class="alert alert-danger nobottommargin">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <i class="icon-info-sign"></i><strong>Info! </strong>Please before confirming the salaries, generate the document and sign it.<br>
                                                        <i class="icon-warning-sign"></i><strong>Warning! </strong>Be careful, your actions are irreversible after you press Confirm Button.
                                                    </div>
                                                </div>

                                                <form method="post">
                                                    <div class="col_one_third">
                                                        <button class="button button-rounded button-border button-teal btn-lg btn-block tright" type="submit" id="print-salary" name="print-salary"
                                                             value="submit">
                                                            Print Salaries<i class="icon-print2"></i></button>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="col_one_third">
                                                        <button class="button button-rounded button-border button-teal btn-lg btn-block tright" type="submit" id="confirm-salary" name="confirm-salary"
                                                                value="submit">
                                                            Confirm Salaries<i class="icon-ok"></i></button>
                                                    </div>

                                            </div>


                                        </div>
                                        <div class="tab-content clearfix" id="tab-information">


                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                <li><i class="icon-user"></i> Drejtoria e Financave</li>
                                                <li><i class="icon-folder-open"></i>Information</li>
                                            </ul>

                                            <div class="content-wrap">

                                                <div class="container clearfix">

                                                    <div class="col_two_third">

                                                        <div class="style-msg2" style="background-color: #EEE;">
                                                            <div class="msgtitle"><i class="icon-pencil2"></i>According to Albanian legislacion for calculation of income taxes, the percantage of social and health insurance are:
                                                            </div>
                                                            <div class="sb-msg">
                                                                <ul>
                                                                    <li>TAP 0-30000(lek) : 0%</li>
                                                                    <li>TAP 30001-130000(lek) : 13%</li>
                                                                    <li>TAP 130001(lek)+: 23%</li>
                                                                    <li>Kontribute shendetesore punonjesi : 1.7%</li>
                                                                    <li>Kontribute shoqerore punonjesi : 9.5%</li>
                                                                    <li>Kontribute shendetesore punedhenesi : 1.7%</li>
                                                                    <li>Kontribute shoqerore punedhenesi : 15%</li>
                                                                </ul>
                                                            </div>
                                                            <i>Approved on 03.12.2016 by Ministry of Finance</i>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-content clearfix" id="tab-settings">


                                            <ul class="entry-meta clearfix">
                                                <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                <li><i class="icon-user"></i> Drejtoria e Financave</li>
                                                <li><i class="icon-folder-open"></i>Settings</li>
                                            </ul>

                                            <div class="content-wrap">

                                                <div class="container clearfix">

                                                    <div class="alert alertmsg col_half">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        <i class="icon-warning-sign"></i><strong>Info!</strong>
                                                        You are changing your password
                                                    </div>
                                                    <div class="col_half">
                                                        <form method="post">
                                                            <div class="col_half">
                                                                <label for="settings-form-old">Old password<small>*</small></label>
                                                                <input type="password" id="settings-form-old" name="settings-form-old" value="" class="required sm-form-control" />
                                                            </div>
                                                            <div class="clear"></div>
                                                            <div class="col_half">
                                                                <label for="settings-form-new">New password<small>*</small></label>
                                                                <input type="password" id="settings-form-new" name="settings-form-new" value="" class="required sm-form-control" />
                                                            </div>
                                                            <div class="clear"></div>
                                                            <div class="col_half col_last">
                                                                <label for="settings-form-reenter">Reenter new password<small>*</small></label>
                                                                <input type="password" id="settings-form-reenter" name="settings-form-reenter" value="" class="required sm-form-control" />
                                                            </div>
                                                            <div class="clear"></div>

                                                            <button class="button button-rounded button-leaf tright"
                                                                    type="submit" id="settings-form-confirm" name="settings-form-confirm" value="submit">
                                                                <i class="icon-key"></i><span> Confirm</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="line visible-xs-block"></div>

                    <div class="col-sm-3 clearfix">

                        <?php if (isset($error)){
                            echo $error;
                        } else {?>

                            <div class="style-msg2" style="background-color: #EEE;">
                                <div class="msgtitle">This is a Notification Bar:</div>
                                <div class="sb-msg">
                                    <ul>
                                        <li>Notifies if you succesfully submit a form</li>
                                        <li>Alerts, if you did something wrong while filling the data</li>
                                    </ul>
                                </div>
                            </div>
                        <?php }?>

                        <div class="fancy-title topmargin title-border">
                            <h4>ZPT</h4>
                        </div>

                        <p>ZPT is a software in help of National Employment Service. It helps jobseekers find a job, businesses to announce
                            vacancies and choose the right candidate. ZPT is a software which performs operations within institution</p>

                        <div class="fancy-title topmargin title-border">
                            <h4>Quick Links</h4>
                        </div>

                        <a href="http://www.kerkojpune.gov.al/adresat-tona/" class="social-icon si-facebook si-small si-rounded si-light" title="Adressat tona">
                            <i class="icon-location"></i>
                            <i class="icon-location"></i>
                        </a>

                        <a href="http://rinia.gov.al/" class="social-icon si-gplus si-small si-rounded si-light" title="Ministria E Mireqenies Socile dhe Rinise">
                            <i class="icon-link"></i>
                            <i class="icon-link"></i>
                        </a>

                        <a href="http://www.vet.al/" class="social-icon si-dribbble si-small si-rounded si-light" title="Arsimi dhe Formimi Profesional">
                            <i class="icon-study"></i>
                            <i class="icon-study"></i>
                        </a>

                        <a href="http://www.sherbimisocial.gov.al/" class="social-icon si-flickr si-small si-rounded si-light" title="Sherbimi Social">
                            <i class="icon-hand-left"></i>
                            <i class="icon-hand-left"></i>
                        </a>

                        <a href="http://www.issh.gov.al/" class="social-icon si-linkedin si-small si-rounded si-light" title="Instituti Sigurimeve Shoqerore">
                            <i class="icon-chevron-sign-down"></i>
                            <i class="icon-chevron-sign-down"></i>
                        </a>



                    </div>

                </div>

            </div>

        </div>

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <?php include('footer.php')?>
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
<!-- Bootstrap Data Table Plugin -->
<script type="text/javascript" src="js/components/bs-datatable.js"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>

<script>

    $(document).ready(function() {
        $('#datatable2').dataTable();
        $('#datatable1').dataTable();
    });
</script>



<script>
    jQuery( "#tabs-profile" ).on( "tabsactivate", function( event, ui ) {
        jQuery( '.flexslider .slide' ).resize();
    });
</script>


</body>
</html>
<?php }?>