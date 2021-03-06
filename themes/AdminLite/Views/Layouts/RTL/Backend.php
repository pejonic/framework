<?php
/**
 * Backend Default RTL Layout
 */

$siteName = Config::get('app.name', SITETITLE);

// Prepare the current User Info.
$user = Auth::user();

// Generate the Language Changer menu.
$langCode = Language::code();
$langName = Language::name();

$languages = Config::get('languages');

//
ob_start();

foreach ($languages as $code => $info) {
?>
<li class="header <?php if ($code == $langCode) { echo 'active'; } ?>">
    <a href='<?= site_url('language/' .$code); ?>' title='<?= $info['info']; ?>'><?= $info['name']; ?></a>
</li>
<?php
}

$langMenuLinks = ob_get_clean();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?> | <?= $siteName; ?></title>
    <?= isset($meta) ? $meta : ''; // Place to pass data / plugable hook zone ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php

echo Assets::build('css', array(
    // Bootstrap 3.3.7
    vendor_url('bower_components/bootstrap/dist/css/bootstrap.min.css', 'almasaeed2010/adminlte'),
    // Bootstrap RTL 3.3.4
    asset_url('css/bootstrap-rtl.min.css', 'themes/bootstrap'),
    // Font Awesome
    vendor_url('bower_components/font-awesome/css/font-awesome.min.css', 'almasaeed2010/adminlte'),
    // Ionicons
    vendor_url('bower_components/Ionicons/css/ionicons.min.css', 'almasaeed2010/adminlte'),
    // Select2
    vendor_url('bower_components/select2/dist/css/select2.min.css', 'almasaeed2010/adminlte'),
    // Theme style
    asset_url('css/AdminLTE.rtl.min.css', 'themes/admin-lite'),
    // AdminLTE Skins
    vendor_url('dist/css/skins/_all-skins.min.css', 'almasaeed2010/adminlte'),
    // Custom CSS
    asset_url('css/style-rtl.css', 'themes/admin-lite'),
));

echo Asset::position('header', 'css');

?>

<style>
.pagination {
    margin: 0;
}

.pagination > li > a, .pagination > li > span {
  padding: 5px 10px;
}
</style>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<?php

echo Assets::build('js', array(
    vendor_url('bower_components/jquery/dist/jquery.min.js', 'almasaeed2010/adminlte'),
));

echo Asset::position('header', 'js');

?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-<?= Config::get('app.color_scheme', 'blue'); ?> sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?= site_url('admin/dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">CP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= __d('admin_lite', 'Control Panel'); ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only"><?= __d('admin_lite', 'Toggle navigation'); ?></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav" style="margin-right: 10px;">
          <li class="dropdown language-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class='fa fa-language'></i> <?= $langName; ?>
            </a>
            <ul class="dropdown-menu">
              <?= $langMenuLinks; ?>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= vendor_url('dist/img/avatar5.png', 'almasaeed2010/adminlte'); ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= $user->username; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= vendor_url('dist/img/avatar5.png', 'almasaeed2010/adminlte'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $user->realname; ?> - <?= implode(', ', $user->roles->lists('name')); ?>
                  <?php $sinceDate = $user->created_at->formatLocalized(__d('admin_lite', '%d %b %Y, %R')); ?>
                  <small><?= __d('admin_lite', 'Member since {0}', $sinceDate); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= site_url('admin/profile'); ?>" class="btn btn-default btn-flat"><?= __d('admin_lite', 'Profile'); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('logout'); ?>" class="btn btn-default btn-flat"><?= __d('admin_lite', 'Sign out'); ?></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form -->
        <form action="<?= site_url('admin/users/search'); ?>" method="POST" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="<?= __d('admin_lite', 'Search...'); ?>">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"><?= __d('admin_lite', 'ADMINISTRATION'); ?></li>
            <?php foreach ($menuItems as $item) { ?>
            <li <?php if ($baseUri == $item['uri']) { echo "class='active'"; } ?>>
                <a href="<?= site_url($item['uri']); ?>"><i class="fa fa-<?= $item['icon'] ?>"></i> <span><?= $item['title']; ?></span></a>
            </li>
            <?php } ?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?= $content; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      <small><!-- DO NOT DELETE! - Statistics --></small>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.novaframework.com/" target="_blank"><b>Nova Framework <?= $version; ?> / Kernel <?= VERSION; ?></b></a> - </strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<?php

echo Asset::render('js', array(
    // Bootstrap 3.3.5
    asset_url('js/bootstrap-rtl.min.js', 'themes/bootstrap'),
    // AdminLTE App
    vendor_url('dist/js/adminlte.min.js', 'almasaeed2010/adminlte'),
    // Select2
    vendor_url('bower_components/select2/dist/js/select2.full.min.js', 'almasaeed2010/adminlte')
));

echo Asset::position('footer', 'js');

?>

<script>
$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<!-- DO NOT DELETE! - Profiler -->

</body>
</html>
