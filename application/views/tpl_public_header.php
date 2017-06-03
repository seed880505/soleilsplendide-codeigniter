<?php
/*@property mixed router*/
$CI = & get_instance();
$currentController = $CI->router->class;
$currentMethod = $CI->router->method;
$pageTitle = "SoleilSplendide | Chenglong GUO";

if (isset($main['striped_title'])) {
    $pageTitle = $main['striped_title'] . " | " . $pageTitle;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Chenglong GUO">
    <meta property="og:image" content="<?php echo base_url("includes/images/soleil_logo.png"); ?>">

    <title><?php echo $pageTitle; ?></title>

    <!--favicon.ico-->
    <link rel="shortcut icon" href="<?php echo base_url("favicon.ico"); ?>"/>
    <link rel="apple-touch-icon" href="<?php echo base_url("favicon.ico"); ?>"/>

    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Niconne' rel='stylesheet' type='text/css'>

    <!--css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("includes/css/normalize.css"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("includes/css/addition.css"); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url("includes/css/jquery-ui/dot-luv/jquery-ui.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("includes/colorbox/example1/colorbox.css"); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url("includes/datatables/media/css/jquery.dataTables_themeroller.css"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("includes/slick/slick.css"); ?>"/>

    <!--LESS CSS-->
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url("includes/css/widgets.less"); ?>"/>


    <!--javascript-->
    <script type="text/javascript" src="<?php echo base_url("includes/jquery/jquery.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("includes/jquery/jquery-ui.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("includes/colorbox/jquery.colorbox-min.js"); ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url("includes/datatables/media/js/jquery.dataTables.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("includes/slick/slick.min.js"); ?>"></script>
    <script type="text/javascript" src="//cdn.sublimevideo.net/js/cbxxb96e.js"></script>

    <!-- Soleil scripts -->
    <script type="text/javascript"
            src="<?php echo base_url("includes/javascripts/module/module-soleil.js"); ?>"></script>

    <!--LESS JS-->
    <script type="text/javascript"
            src="<?php echo base_url("includes/less/less.min.js"); ?>"></script>

    <!--google map api-->
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuI8GODKT_tkkT1FDTJ4pWUFRtoUGXMbM&sensor=true"></script>

</head>


<body>

<header>

    <div id="logo_area" class="logo_area_style">

        <!--Logo image-->
        <div class="logo_img">
            <a href="<?php echo site_url() ?>"><img
                    src="<?php echo base_url("includes/images/soleil_logo.png"); ?>"></a>
        </div>

        <!--Logo text-->
        <div class="logo_text">
            <a class="active_section" href="<?php echo site_url() ?>">SoleilSplendide</a>
        </div>

        <!--Search bar-->
        <div class="search_bar">
            <form id="searchBarForm" action="<?php echo site_url('blog/searchblog'); ?>" method="post">
                <div class="searchQuery">
                    <input id="search_blog" type="text" name="search_text">
                </div>
                <div id="search-submit" class="searchSubmit"></div>
                <input type="hidden" name="search_type" value="table">
            </form>
        </div>
    </div>

    <div id="menu_area" class="menu_area_style">

        <!--Menu bar-->
        <?php
        /** @noinspection PhpUndefinedFieldInspection */
        if ($CI->session->userdata('logged_in')) {
            ?>
            <ul class="nav">
                <li>
                    <a <?php if ($currentController === 'home') echo 'class="active_section"' ?>
                        href="<?php echo site_url('home'); ?>">Home</a>
                </li>
                <li>
                    <a <?php if ($currentController === 'blog') echo 'class="active_section"' ?>
                        href="<?php echo site_url('blog'); ?>">Blog</a>
                </li>
                <li>
                    <a href="<?php echo site_url('file'); ?>">My File</a>
                </li>
                <li>
                    <a href="<?php echo site_url("auth/logout"); ?>">Disconnect</a>
                </li>
            </ul>
        <?php
        } else {
            ?>
            <ul class="nav">
                <li>
                    <a <?php if ($currentController === 'home') echo 'class="active_section"' ?>
                        href="<?php echo site_url('home'); ?>">Home</a>
                </li>
                <li>
                    <a <?php if ($currentController === 'blog') echo 'class="active_section"' ?>
                        href="<?php echo site_url('blog'); ?>">Blog</a>
                </li>
                <li>
                    <a <?php if ($currentController === 'contact') echo 'class="active_section"' ?>
                        href="<?php echo site_url('contact'); ?>">Contact Me</a>
                </li>
                <li>
                    <a id="userLogin" href="<?php echo site_url("auth"); ?>">Sign In</a>
                </li>
            </ul>
        <?
        }
        ?>

        <div class="divider">
            <div id="header_sub_menu"></div>
        </div>

        <div class="SS_clear"></div>
    </div>


</header>

<?php
//custom style sheet
if ($currentController === 'home') {
    ?>
    <script>
        SOLEIL.Global.currentPage = 'home';
        SOLEIL.Global.activeColor = '#00CCFF';
    </script>
<?php
}elseif ($currentController === 'blog'){
?>
    <script>
        SOLEIL.Global.currentPage = 'blog';
        SOLEIL.Global.activeColor = '#ff3300';
    </script>
<?php
}elseif ($currentController === 'contact'){
?>
    <script>
        SOLEIL.Global.currentPage = 'contact';
        SOLEIL.Global.activeColor = '#00D8CC';
    </script>
<?php
}elseif ($currentController === 'file'){
?>
    <script>
        SOLEIL.Global.currentPage = 'file';
        SOLEIL.Global.activeColor = '#BAD80A';
    </script>
<?
}
?>

<script>
    //Host name
    SOLEIL.Global.hostName = '<?php echo site_url(); ?>';
    SOLEIL.Global.baseUrl = '<?php echo base_url(); ?>';
</script>

<?php
//User session
if ($CI->session->userdata('logged_in')) {
    ?>
    <script>
        SOLEIL.Global.userLogin = true;
    </script>
<?php
}
?>

<script type="text/javascript"
        src="<?php echo base_url("includes/javascripts/events/event-global.js"); ?>"></script>