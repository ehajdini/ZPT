<?php
session_start();
require_once("classes/workingStaff.php");
require_once("classes/jobseeker.php");
require_once("classes/crud_class.php");
require_once("classes/crud_jobseekers.php");

if (isset($_SESSION['name'])&& isset($_SESSION['surname'])&& isset($_SESSION['id'])&& isset($_SESSION['directory']))
{
    $name=$_SESSION['name'];
    $surname=$_SESSION['surname'];
    $directory=$_SESSION['directory'];
    $id=$_SESSION['id'];
    $content=new crud_class();
    $jobseekerList=new crud_jobseekers();
    $result=$jobseekerList->read();
    $results=$jobseekerList->requestAssistance();
    $legalresults=$jobseekerList->requestAppointment();
    $newresults=$jobseekerList->read();

    if(isset($_POST['settings-form-confirm']) && isset($_POST['settings-form-confirm']) && isset($_POST['settings-form-old'] )
        && isset($_POST['settings-form-new'])&& isset($_POST['settings-form-reenter']) ){
        if(md5($_POST['settings-form-old'])==$_SESSION['password']){
            if($_POST['settings-form-new']==$_POST['settings-form-reenter']){
                $pass=$_POST['settings-form-reenter'];
                $content->updatePassword($id,$pass);
                $_SESSION['error']=$content->getError();
                session_destroy();
                header("location:index.php");
            }
        }
    }

    if(isset($_POST['assistance-submit'])){
        $row=$jobseekerList->assistance($_POST['pid']);
        $error=$jobseekerList->getError();
        header("Refresh:2");
    }

    if(isset($_POST['appointment-submit'])){
        $row=$jobseekerList->appointment($_POST['pid']);
        $error=$jobseekerList->getError();
        header("Refresh:2");
    }
    if(isset($_POST['remove-submit'])){
        $jobseekerList->delete($_POST['pid']);
        $error=$jobseekerList->getError();
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
                $content->updatePassword($id,$pass);
                $_SESSION['error']=$content->getError();
                header("location:index.php");
            }
        }
    }
    
    if(isset($_POST['register-form-submit'])) {
        $wname=$_POST['register-form-name'];
        $wsurname=$_POST['register-form-surname'];
        $wid=$_POST['register-form-id'];
        $position=$_POST['register-form-position'];
        $phone=$_POST['register-form-phone'];
        $email=$_POST['register-form-email'];
        $gender=$_POST['register-form-gender'];
        $jobseeker=new jobseeker($wid,$wname,$wsurname,$position,$email,$phone,$gender);
        $CRUD=new crud_jobseekers();
        $CRUD->create($jobseeker);
        $error=$CRUD->getError();
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
                        <a href="#" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="Logo"></a>
                        <a href="#" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="images/logo.png" alt="Logo"></a>
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
                                            <li><a href="#tab-list"><i class="icon-users"></i>Jobseekers</a></li>
                                            <li><a href="#tab-new"><i class="icon-plus"></i> New jobseeker</a></li>
                                            <li><a href="#tab-assistance"><i class="icon-check"></i>Assistance</a></li>
                                            <li><a href="#tab-legal"><i class="icon-legal"></i>Legal Advice</a></li>
                                            <li><a href="#tab-remove"><i class="icon-remove"></i> Remove</a></li>
                                            <li><a href="#tab-settings"><i class="icon-settings"></i> Settings</a></li>
                                        </ul>

                                        <div class="tab-container">

                                            <div class="tab-content clearfix" id="tab-profile">
                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
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
                                            <div class="tab-content clearfix" id="tab-list">
                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i>List of jobseekers</li>
                                                </ul>
                                                <div class="content-wrap">

                                                    <div class="container clearfix">

                                                        <div class="table-responsive">

                                                            <table id="datatable2" class="table table-striped table-bordered" cellspacing="0" width="70%">
                                                                <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Name Surname</th>
                                                                    <th>Profession</th>
                                                                    <th>Registered Date</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>
                                                                    <th>Gender</th>
                                                                </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Name Surname</th>
                                                                    <th>Profession</th>
                                                                    <th>Registered Date</th>
                                                                    <th>Phone</th>
                                                                    <th>Email</th>
                                                                    <th>Gender</th>
                                                                </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php
                                                                while($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['ID'] ?></td>
                                                                        <td><?php echo $row['Name']." ".$row['Surname'] ?></td>
                                                                        <td><?php echo $row['Profession']?></td>
                                                                        <td><?php echo $row['Registerdate']?></td>
                                                                        <td><?php echo $row['Number']?></td>
                                                                        <td><?php echo $row['Email']?></td>
                                                                        <td><?php echo $row['Gender']?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>

                                                </div>


                                            </div>
                                            <div class="tab-content clearfix" id="tab-new">
                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i> Registering new jobseeker</li>
                                                </ul>

                                                <div class="clear topmargin-sm"></div>

                                                <div class="postcontent bothsidebar nobottommargin">


                                                    <!-- Contact Form
                                                    ============================================= -->
                                                    <h3>Register new jobseeker</h3>

                                                    <div class="">

                                                        <form method="post">


                                                            <div class="col_two_third">
                                                                <label for="register-form-name">Name <small>*</small></label>
                                                                <input type="text" id="register-form-name" name="register-form-name" value="" class="sm-form-control required" />
                                                            </div>


                                                            <div class="col_one_third col_last">
                                                                <label for="register-form-phone">Phone</label>
                                                                <input type="text" id="register-form-phone" name="register-form-phone" value="" class="sm-form-control" />
                                                            </div>

                                                            <div class="clear"></div>

                                                            <div class="col_two_third">
                                                                <label for="register-form-surname">Surname <small>*</small></label>
                                                                <input type="text" id="contactform-surname" name="register-form-surname" value="" class="sm-form-control required" />
                                                            </div>

                                                            <div class="col_one_third col_last">
                                                                <label for="register-form-id">ID number <small>*</small></label>
                                                                <input type="text" id="register-form-id" name="register-form-id" value="" class="required sm-form-control" />

                                                            </div>


                                                            <div class="clear"></div>

                                                            <div class="col_two_third">
                                                                <label for="register-form-email">Email <small>*</small></label>
                                                                <input type="email" id="register-form-email" name="register-form-email" value="" class="required email sm-form-control" />
                                                            </div>

                                                            <div class="col_one_third col_last">
                                                                <label for="register-form-position">Profession <small>*</small></label>
                                                                <input type="text" id="register-form-position" name="register-form-position" value="" class="required sm-form-control" />

                                                            </div>
                                                            <div class="clear"></div>

                                                            <div class="clear"></div>
                                                            <div class="col_full">
                                                                <label for="register-form-gender">Gender<small>*</small></label>
                                                                <select name="register-form-gender" class="select-1 form-control" id="register-form-gender" style="width:100%;">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="clear"></div>
                                                            <div class="col_full">
                                                                <button class="button button-border button-rounded button-fill button-teal btn-lg btn-block tright" type="submit" id="register-form-submit" name="register-form-submit" value="submit">Register <i class="icon-circle-arrow-right"></i></button>
                                                            </div>

                                                        </form>

                                                    </div>


                                                    <div class="line"></div>



                                                </div><!-- .postcontent end -->

                                            </div>
                                            <div class="tab-content clearfix" id="tab-assistance">


                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i> Request for assistance</li>
                                                </ul>

                                                <div class="content-wrap">


                                                    <div class="container clearfix">
                                                        <div class="alert successmsg col_two_third">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <i class="icon-warning-sign"></i><strong>Info!</strong><br>
                                                            Every jobseeker who doesn't have a profile may apply for assistance through Drejtoria e Sherbimeve Mbeshtetese
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="table-responsive">
                                                            <table id="datatable1" class="table table-hover " width="70%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Name Surname</th>
                                                                    <th>ID</th>
                                                                    <th>Register Date</th>
                                                                    <th>Gender</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Name Surname</th>
                                                                    <th>ID</th>
                                                                    <th>Register Date</th>
                                                                    <th>Gender</th>
                                                                    <th></th>
                                                                </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php
                                                                while($row = $results->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['Name']." ".$row['Surname'] ?></td>
                                                                        <td><?php echo $row['ID']?></td>
                                                                        <td><?php echo $row['Registerdate']?></td>
                                                                        <td><?php echo $row['Gender']?></td>
                                                                        <td>
                                                                            <form method="post">
                                                                                <input type="hidden" name="pid" value="<?php echo $row['ID'];?>">

                                                                                <button class="button button-mini button-border button-rounded button-teal tright" type="submit" id="assistance-submit" name="assistance-submit" value="submit">Request for Assistance<i class="icon-ok-sign"></i></button>

                                                                            </form>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>

                                                </div>


                                            </div>
                                            <div class="tab-content clearfix" id="tab-legal">


                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i> Request for Legal Advice</li>
                                                </ul>

                                                <div class="content-wrap">


                                                    <div class="container clearfix">
                                                        <div class="alert successmsg col_two_third">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <i class="icon-warning-sign"></i><strong>Info!</strong><br>
                                                            Every jobseeker who doesn't have a profile may apply for legal Advice through Drejtoria e Sherbimeve Mbeshtetese
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="table-responsive">
                                                            <table id="datatable4" class="table table-hover " width="70%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Name Surname</th>
                                                                    <th>ID</th>
                                                                    <th>Register Date</th>
                                                                    <th>Gender</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Name Surname</th>
                                                                    <th>ID</th>
                                                                    <th>Register Date</th>
                                                                    <th>Gender</th>
                                                                    <th></th>
                                                                </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php
                                                                while($row = $legalresults->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['Name']." ".$row['Surname'] ?></td>
                                                                        <td><?php echo $row['ID']?></td>
                                                                        <td><?php echo $row['Registerdate']?></td>
                                                                        <td><?php echo $row['Gender']?></td>
                                                                        <td>
                                                                            <form method="post">
                                                                                <input type="hidden" name="pid" value="<?php echo $row['ID'];?>">

                                                                                <button class="button button-mini button-border button-rounded button-teal tright" type="submit" id="appointment-submit" name="appointment-submit" value="submit">Request for Appointment<i class="icon-ok-sign"></i></button>

                                                                            </form>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>

                                                </div>


                                            </div>
                                            <div class="tab-content clearfix" id="tab-remove">


                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i>Remove from list of Jobseekers</li>
                                                </ul>

                                                <div class="content-wrap">

                                                    <div class="container clearfix">

                                                        <div class="alert errormsg col_two_third">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <i class="icon-warning-sign"></i><strong>Info!</strong><br>
                                                             After a jobseeker finds a work, it is directly removed from list of jobseekers.<br>
                                                            It's his duty or the business employing him must notify ZPT
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="table-responsive">
                                                            <table id="datatable3" class="table table-hover " width="70%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Name Surname</th>
                                                                    <th>ID</th>
                                                                    <th>Register Date</th>
                                                                    <th>Gender</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Name Surname</th>
                                                                    <th>ID</th>
                                                                    <th>Register Date</th>
                                                                    <th>Gender</th>
                                                                    <th></th>
                                                                </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php
                                                                while($row = $newresults->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['Name']." ".$row['Surname'] ?></td>
                                                                        <td><?php echo $row['ID']?></td>
                                                                        <td><?php echo $row['Registerdate']?></td>
                                                                        <td><?php echo $row['Gender']?></td>
                                                                        <td>
                                                                            <form method="post">
                                                                                <input type="hidden" name="pid" value="<?php echo $row['ID'];?>">

                                                                                <button class="button button-mini button-border button-rounded button-red tright" type="submit" id="remove-submit" name="remove-submit" value="submit">Remove form List<i class="icon-remove-sign"></i></button>

                                                                            </form>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content clearfix" id="tab-settings">


                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i>Drejtoria e Sherbimeve Mbeshtetese</li>
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
            $('#datatable3').dataTable();
            $('#datatable4').dataTable();
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