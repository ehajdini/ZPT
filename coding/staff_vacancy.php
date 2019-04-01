<?php
session_start();
require_once("classes/workingStaff.php");
require_once("classes/crud_class.php");
require_once("classes/crud_vacancy.php");
require_once("classes/vacancy.php");

if (isset($_SESSION['name'])&& isset($_SESSION['surname'])&& isset($_SESSION['id'])&& isset($_SESSION['directory']))
{
    $name=$_SESSION['name'];
    $surname=$_SESSION['surname'];
    $directory=$_SESSION['directory'];
    $id=$_SESSION['id'];
    $content=new crud_class();
    $vacancyList=new crud_vacancy();
    $result=$vacancyList->read();
    $results=$vacancyList->read();
    $businessList=$vacancyList->getBusiness();

    if(isset($_POST['delete'])){
        $vacancyList->delete($_POST['pid']);
        $error=$vacancyList->getError();
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
        $nipt=$_POST['nipt'];
        $position=$_POST['register-form-position'];
        $places=$_POST['register-form-places'];
        $announced_date=date('d-m-Y');

        $vacancy=new vacancy($nipt,$position,$places,$announced_date);

        $CRUD=new crud_vacancy();
        $CRUD->create($vacancy);
        $error=$CRUD->getError();
        header("Refresh:2");

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
                        <a href="index.php" class="standard-logo" data-dark-logo="images/logo-dark.png"><img src="images/logo.png" alt="Logo"></a>
                        <a href="index.php" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img src="images/logo.png" alt="Logo"></a>
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
                                            <li><a href="#tab-list"><i class="icon-users"></i> List of all vacancies</a></li>
                                            <li><a href="#tab-new"><i class="icon-plus"></i> New vacancy</a></li>
                                            <li><a href="#tab-delete"><i class="icon-remove-sign"></i>Delete vacancy</a></li>
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
                                                    <li><i class="icon-folder-open"></i>List of all vacancies</li>
                                                </ul>
                                                <div class="content-wrap">

                                                    <div class="container clearfix">

                                                        <div class="table-responsive">

                                                            <table id="datatable2" class="table table-striped table-bordered" cellspacing="0" width="70%">
                                                                <thead>
                                                                <tr>
                                                                    <th>Num</th>
                                                                    <th>NIPT</th>
                                                                    <th>Position</th>
                                                                    <th>Available Places</th>
                                                                    <th>Announced Date</th>
                                                                </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Num</th>
                                                                    <th>NIPT</th>
                                                                    <th>Position</th>
                                                                    <th>Available Places</th>
                                                                    <th>Announced Date</th>
                                                                </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php
                                                                while($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['id']?></td>
                                                                        <td><?php echo $row['nipt']?></td>
                                                                        <td><?php echo $row['position']?></td>
                                                                        <td><?php echo $row['places']?></td>
                                                                        <td><?php echo $row['announced_date']?></td>
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
                                                    <li><i class="icon-user"></i>Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i> New Vacancy</li>
                                                </ul>

                                                <div class="clear topmargin-sm"></div>

                                                <div class="postcontent bothsidebar nobottommargin">


                                                    <!-- Contact Form
                                                    ============================================= -->
                                                    <h3>New Vacancy</h3>

                                                    <div class="">

                                                        <form action="#" method="post">


                                                            <div class="col_two_third">
                                                                <label for="nipt">Business NIPT</label>
                                                                <select id="nipt" name="nipt" class="sm-form-control required">
                                                                    <?php
                                                                    while($rows = $businessList->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?php echo $rows['nipt'];?>"><?php echo $rows['name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>


                                                            <div class="col_one_third col_last">
                                                                <label for="register-form-places">Places Available</label>
                                                                <input type="number" id="register-form-places" min="1" name="register-form-places" value="" class="sm-form-control" />
                                                            </div>

                                                            <div class="clear"></div>

                                                            <div class="col_two_third">
                                                                <label for="register-form-position">Position<small>*</small></label>
                                                                <input type="text" id="register-form-position" name="register-form-position" value="" class="sm-form-control required" />
                                                            </div>

                                                            <div class="clear"></div>
                                                            <div class="col_full">
                                                                <button class="button button-border button-rounded button-fill button-teal btn-lg btn-block tright" type="submit" id="register-form-submit" name="register-form-submit" value="submit">Register <i class="icon-circle-arrow-right"></i></button>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </form>

                                                    </div>


                                                    <div class="line"></div>



                                                </div><!-- .postcontent end -->

                                            </div>
                                            <div class="tab-content clearfix" id="tab-delete">


                                                <ul class="entry-meta clearfix">
                                                    <li><i class="icon-calendar3"></i><?php echo date('d-m-Y')?></li>
                                                    <li><i class="icon-user"></i> Drejtoria e Sherbimeve Mbeshtetese</li>
                                                    <li><i class="icon-folder-open"></i> Delete Vacancy</li>
                                                </ul>

                                                <div class="content-wrap">


                                                    <div class="container clearfix">

                                                        <div class="table-responsive">
                                                            <table id="datatable1" class="table table-hover " width="70%">
                                                                <thead>
                                                                <tr>
                                                                    <th>NIPT</th>
                                                                    <th>Position</th>
                                                                    <th>Announced Date</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>NIPT</th>
                                                                    <th>Position</th>
                                                                    <th>Announced Date</th>
                                                                    <th></th>
                                                                </tr>
                                                                </tfoot>
                                                                <tbody>
                                                                <?php
                                                                while($row = $results->fetch_assoc()) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $row['nipt']?></td>
                                                                        <td><?php echo $row['position']?></td>
                                                                        <td><?php echo $row['announced_date']?></td>
                                                                        <td>
                                                                            <form method="post">
                                                                                <input type="hidden" name="pid" value="<?php echo $row['id'];?>">

                                                                                <button class="button button-mini button-border button-rounded button-red tright" type="submit" id="delete" name="delete" value="submit">Delete <i class="icon-remove"></i></button>

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
                                                    <li><i class="icon-user"></i>  Drejtoria e Sherbimeve Mbeshtetese</li>
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