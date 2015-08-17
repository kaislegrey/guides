<?php
/**
 * @file
 * First we need to work out how many columns we are rendering.
 */
if (($page['sidebar_first']) || ($page['sidebar_second'])) {
  // At least two columns
  $cols = 2;
  $contentwidth = 'large-4';
  if (($page['sidebar_first']) && ($page['sidebar_second'])) {
    $cols = 3;
    $contentwidth = 'large-2';
  }
}
else {
  // Only the content column
  $cols = 1;
  $contentwidth = 'large-6';
}
?>

<!-- begin user menu -->
<?php if ($page['usermenu']) { ?>
  <section id="usermenu" class="show-for-large-up">
    <div class="row">
      <div class="small-12 column">
        <?php print render($page['usermenu']); ?>
      </div>
    </div>
  </section>
<?php } ?>
<!-- end user menu  -->

<!-- begin header -->
<header>
  <div class="row">
    <div class="large-12 column">
      <!-- begin site name / logo -->
      <div class="large-2 columns name">
        <?php if ($site_name) { ?>
        <h1 class = "site-name"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a></h1>
        <?php } // site-name  ?>
      </div>
      <!-- end site name / logo -->

      <!-- begin search -->
      <?php if ($page['search']) {?>
        <div class="search-bar large-2 columns">
          <?php print render($page['search']); ?>
        </div>
      <?php } ?>
      <!-- end search -->

      <!-- begin primarymainmenu -->
      <div id="primarymainmenu" class="large-2 columns">
        <div class="row">
          <div>
            <nav class="top-bar" data-topbar>

              <ul class="title-area">
                <?php if ($site_name) { ?>
                <li class="name"><h1 class = "site-name hide"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a></h1></li>
                <?php } ?>
                <li class="toggle-topbar menu-icon show-for-medium-down"><a href="#"><span>Menu</span></a></li>
              </ul>

              <section class="top-bar-section">
                <?php
                  $main_menu_attributes = array(
                    'id'     => 'main-menu-links',
                    'class'  => array('left'),
                  );
                  print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => $main_menu_attributes,));
                ?>
              </section>

            </nav>
          </div>
        </div>
      </div>
      <!-- end primarymainmenu -->

    </div>
  </div><!-- row -->
</header>
<!-- end header -->

<!-- begin mission -->
<?php if (($is_front) && ($page['mission'])) { ?>
  <div id="mission" class="show-for-medium-up">
    <div class="row">
      <div class="small-12 column">
        <h1 class="pagetitle"><?php print $title ?></h1>
        <?php print render($page['mission']); ?>
      </div>
    </div>
  </div>
<?php } ?>
<!-- end mission -->

<!-- begin content -->
<section id="content">

  <!-- begin tab navigation -->
  <?php if (!empty($tabs['#primary'])) { ?>
    <section class="row tab-nav">
      <?php if ($tabs['#primary']) { ?>
        <nav id="tabnav" class="clearfix column">
          <?php print render($tabs); ?>
        </nav>
      <?php } ?>
    </section>
  <?php } ?>
  <!-- end tab navigation -->

  <!-- begin messages -->
  <?php if ($messages) { ?>
    <section class="wrapper row messages">
      <div class="inner">
        <?php print ($messages); ?>
      </div>
    </section>
  <?php } ?>
  <!-- end messages -->

  <div class="row">

    <!-- begin sidebar first -->
    <?php if ($page['sidebar_first']) { ?>
      <div id="sidebar-first" class="large-2 columns">
        <?php print render($page['sidebar_first']); ?>
      </div>
    <?php } ?>
    <!-- end sidebar first -->

    <!-- begin page content-->
    <div id="pageContent" class="<?php print ($contentwidth); ?> columns">

      <!-- begin highlighted-->
      <?php if ($page['highlighted']) { ?>
        <div id="highlighted">
          <?php print render($page['highlighted']); ?>
        </div>
      <?php } ?>
      <!-- end highlighted-->

      <!-- begin NOT FRONT title-->
      <?php if (($title) && (!$is_front)) { ?>
        <?php print render($title_prefix); ?>
          <h1 class="pagetitle">
            <?php print $title ?>
          </h1>
        <?php print render($title_suffix); ?>
      <?php } ?>
      <!-- end NOT FRONT title-->

      <!-- begin help-->
      <?php if ($page['help']) { ?>
        <div id="drupalhelp">
          <?php print render($page['help']); ?>
        </div>
      <?php } ?>
      <!-- end help-->

      <!-- begin action links-->
      <?php if ($action_links) { ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php } ?>
      <!-- end action links-->

      <div class="pageContent">
        <?php print render($page['content']); ?>
      </div>

    </div>
    <!-- end page content-->

    <!-- begin side bar second-->
    <?php if ($page['sidebar_second']) { ?>
      <div id="sidebar-second" class="large-2 columns">
        <?php print render($page['sidebar_second']); ?>
      </div>
    <?php } ?>
  <!-- end side bar second-->

  </div>

</section>
<!-- end content -->

<!-- begin monotych first -->
<?php if ($page['monotych_first']) {?>
<section id="monotych-first">
  <div class="row">
    <div class="large-6 column">
      <?php print render($page['monotych_first']); ?>
    </div>
  </div>
</section>
<?php } ?>
<!-- end monotych first -->

<!-- begin monotych first -->
<?php if ($page['monotych_last']) {?>
<section id="monotych-last">
  <div class="row">
    <div class="large-6 column">
      <?php print render($page['monotych_last']); ?>
    </div>
  </div>
</section>
<?php } ?>
<!-- end monotych first -->


<!-- begin footer -->
<footer>

  <div class = "row">

  <?php if ($page['footermenu']) {?>
    <div class="footer-menu show-for-medium-up">
      <div id="menublocks" class="large-6 columns">
        <?php print render($page['footermenu']); ?>
      </div>
    </div><!-- row -->
  <?php } ?>

    <div class="large-6 columns">

      <?php if ($site_name) { ?>
        <h1 class = "site-name large-2 columns">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
            <?php print $site_name; ?>
          </a>
        </h1>
      <?php } ?>

      <div id="footermessage" class="large-2 columns">
        <p>Copyright &copy; <?php print date("Y"); ?> PurpleMonkeyEvents</p>
        <p>some rights reserved. Terms and conditions apply.</p>
      </div>

      <div id="colophon" class="large-2 columns">
        <ul>
          <li>
            <a class="colophon drupal" title="Drupal - Open Source CMS | Drupal.org" href="http://drupal.org">Drupal.org</a>
          </li>
          <li>
            <a class="colophon telamenta" title="Telamenta.com" href="http://telamenta.com">Telamenta grown</a>
          </li>
        </ul>
      </div><!-- colophon -->

    </div><!-- row: Collapse -->

  </div>

</footer>
<!-- end footer -->
