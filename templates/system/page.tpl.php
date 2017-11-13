<?php

/**
 * @file
 * Displays a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   element.
 * - $head: Markup for the HEAD element (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the
 *   current path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled in
 *   theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been
 *   disabled in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been
 *   disabled.
 * - $primary_links (array): An array containing primary navigation links for
 *   the site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links
 *   for the site, if they have been configured.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $content: The main content of the current Drupal page.
 * - $right: The HTML for the right sidebar.
 * - $node: The node object, if there is an automatically-loaded node associated
 *   with the page, and the node ID is the second argument in the page's path
 *   (e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic
 *   content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta name="viewport" content="width=device-width,user-scalable=no" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='//fonts.googleapis.com/css?family=Titillium+Web:400,700,600,300' rel='stylesheet' type='text/css'>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
</head>
<body class="<?php print $body_classes; ?>">
  <div id="header" class="top-header hidden-xs">
  	<div class="container">
    	<div id="logo-title" class="pull-left logo">
			<?php if (!empty($logo)): ?>
              <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?> Home" rel="home" id="logo">
                <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
              </a>
            <?php endif; ?>
      	</div> <!-- /logo-title -->
        
        <?php //if (!empty($search_box)): ?>
        <!--<div id="search-box"><?php //print $search_box; ?></div>-->
      <?php //endif; ?>
      
      <span class="top-log pull-right">				  
     	<?php if ($logged_in) { ?>
        	<?php if ($is_admin) ?>
            <a href="/user" class="signup"><span class="hidden-text">Profile</span>Profile</a>
            <a href="/logout" class="login">Log out</a>
            <?php } else { ?>
            <a href="/user/register" class="signup">Sign up</a>
            <a href="/user/login" class="login">Login</a>
        <?php } ?>
     </span>

      <?php if (!empty($header)): ?>
        <div id="header-region" class="pull-right list-style top-login">
          <?php print $header; ?>
        </div>
      <?php endif; ?>
      
      <div class="top-contact list-style pull-right">
		<ul>
			<li><?php print $company_phone; ?></li>
            <?php if(!empty($company_phone) && !empty($site_mail)) print '  '; ?>
            <?php if(!empty($site_mail)) {
            print '<li><a href="mailto:' . $site_mail . '" title="Email us">' . $site_mail . '</a></li>';
            } ?>
		</ul>
      </div><!-- top-contact end -->
      
      <div id="navigation" class="menu top-nav <?php if (!empty($primary_links)) { print "withprimary"; } if (!empty($secondary_links)) { print " withsecondary"; } ?> ">
        <?php if (!empty($primary_links)): ?>
          <div id="primary" class="clear-block">
            <?php print theme('links', $primary_links, array('class' => 'links primary-links')); ?>
            <div class="search-icon pull-left"><a data-toggle="modal" href="#modalsearch"><i class="fa fa-search"></i><span class="hidden-text">search</span></a>
</div>
          </div>
        <?php endif; ?>
      </div><!-- /navigation -->
       
    </div><!-- container end -->
  </div><!-- /header -->
  
  <div id="mobile-header" class="visible-xs mobile-header-top">
  	<div class="container">
    	<div class="row">
        	<div class="navbar-header"<?php print $mobile_nav_bg; ?>>
				<div class="plus mobile-icon visible-xs" data-toggle="collapse" data-target=".navbar-ex1-collapse1"><i class="fa fa-plus"></i></div>
				<?php if(!empty($site_mail)) {
                print '<a href="mailto:' . $site_mail . '" class="email mobile-icon visible-xs"><i class="fa fa-envelope"></i><span class="hidden-text">mail</span></a>';
                print '<a href="tel:' . $company_phone . '" class="phone mobile-icon visible-xs"><i class="fa fa-phone"></i><span class="hidden-text">Tel</span></a>';
                } ?>
				<div class="plus mobile-icon visible-xs" data-toggle="collapse" data-target=".navbar-ex1-collapse2">
					<?php if ($logged_in) { ?>
                        <?php if ($is_admin) ?>
                         <i class="fa fa-sign-out"></i>
                        <?php } else { ?>
                        <i class="fa fa-sign-in"></i>
                    <?php } ?>
                </div>
				<a data-toggle="modal" href="#modalsearch" class="m-search mobile-icon visible-xs"><i class="fa fa-search"></i><span class="hidden-text">search</span></a>
              	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              	</button>
        	</div><!-- Navbar Header End -->
            
            <div class="collapse navbar-collapse navbar-ex1-collapse">
          	  <div class="top-nav list-ul list-style">
			  	<?php print theme('links', $primary_links, array('class' => 'primary-links'), 'primary-links'); ?>
              </div>
        	</div><!-- Navbar Ex1 Collapse End -->
            
            <div class="collapse navbar-collapse navbar-ex1-collapse1">
              	<div class="addthis_horizontal_follow_toolbox pull left"></div>
        	</div><!-- navbar-ex1-collapse1 End -->
            
            <div class="collapse navbar-collapse navbar-ex1-collapse2">
              <div class="visible-xs navbar-utilities">
                <ul class="list-style">
                    <li><a href="">Client login</a></li> 
                    <li>
                    	<?php if ($logged_in) { ?>
							<?php if ($is_admin) ?>
                                  <a href="/logout"><span class="hidden-text">Logout</span>Logout</a>
                            <?php } else { ?>
                        	<a href="/user/login"><span class="hidden-text">Login</span>Login</a>
                    	<?php } ?>
                    </li>
                    
                    <li>
						<?php if ($logged_in) { ?>
							<?php if ($is_admin) ?>
                                <a href="/user" class="login"><span class="hidden-text">Profile</span>Profile</a>
									<?php } else { ?>
                                <a href="/user/register" class="login"><span class="hidden-text">Register</span>Register</a>
						<?php } ?>
                    </li> 
                </ul>
              </div>
        	</div><!-- navbar-ex1-collapse2 End -->
            
            <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?> home" class="mobile-header-bottom col-xs-12 text-alin">
				<?php if ($mobile_logo == TRUE) { ?>
                  <img src="<?php print base_path().path_to_theme();?>/images/chadwick_logo.png" alt="chadwick_logo">
                <?php } else { ?>
                  <img src="<?php print base_path().path_to_theme();?>/images/chadwick_logo.png" alt="chadwick_logo">
                <?php }; ?>          
      		</a>
            
        </div>
    </div>
  </div><!-- Mobile Header End -->
  
  <?php if ($banner || !empty($title) || (isset($strap)) || (isset($strapline))) {
    print '<div class="jumbotron"><div class="container"><div class="row">';
		print '<div class="col-xs-12 col-sm-7 col-sm-push-5">' . $banner . '</div>';
		print '<div class="col-xs-12 col-sm-5 col-sm-pull-7 inner-banner-text"><h1 class="title" id="page-title">' . $title . '</h1> <p>' . $strap . '' . $strapline .'</p></div>';
    print '</div></div></div>';
  } ?>
  
  	<?php if (!empty($elevator)): ?>
  		<div class="elevator">
        	<div class="container">
            	<div class="row">
                	<div class="elevator-text"><p><?php print $elevator; ?></p></div>
                </div>
            </div>
        </div>
	<?php endif; ?>
 

  <div id="page" class="container test">
    <div id="container" class="clear-block">
    	<?php if (!empty($breadcrumb)): ?><div id="breadcrumb"><?php print $breadcrumb; ?></div><?php endif; ?>
      <div id="main" class="column"><div id="main-squeeze">
        
        <?php if (!empty($mission)): ?><div id="mission"><?php print $mission; ?></div><?php endif; ?>

        <div id="content">
          <!--<?php //if (!empty($title)): ?><h1 class="title" id="page-title"><?php //print $title; ?></h1><?php //endif; ?>-->
          <?php if (!empty($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
          <?php if (!empty($messages)): print $messages; endif; ?>
          <?php if (!empty($help)): print $help; endif; ?>
          <div id="content-content" class="clear-block">
            <?php print $content; ?>
          </div> <!-- /content-content -->
          <?php print $feed_icons; ?>
        </div> <!-- /content -->
        
        <?php if ($content_bottom) {
          print '<div id="content-bottom"><div class="row">';
            print $content_bottom;
          print '</div></div>';
        } ?>
        

      </div></div> <!-- /main-squeeze /main -->
      
      <?php if (!empty($left)): ?>
        <div id="sidebar-left" class="column sidebar">
          <?php print $left; ?>
        </div> <!-- /sidebar-left -->
      <?php endif; ?>

      <?php if (!empty($right)): ?>
        <div id="sidebar-right" class="column sidebar">
          <?php print $right; ?>
        </div> <!-- /sidebar-right -->
      <?php endif; ?>

    </div> <!-- /container -->

    

    <?php print $closure; ?>

  </div> <!-- /page -->
  
  <div class="footer-top text-alin">
  	<div class="container">
    	<?php if (!empty($secondary_links)): ?>
        	<div id="secondary" class="clear-block secondary-links">
                <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')); ?>
            </div>
        <?php endif; ?>
    </div>
  </div><!-- Footer Top End -->

  <div id="footer-wrapper" class="footer">
      <div id="footer">
      	<div class="container">
        	<div class="row">
                <?php if (!empty($footer)): print $footer; endif; ?>
            </div>
        </div>
      </div> <!-- /footer -->
  </div><!-- /footer-wrapper -->
  
  <!-- Modal Search -->
  <div class="modal fade" id="modalsearch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title">Search</h2>
        </div>
        <div class="modal-body">
        <!--<label for="edit-search-theme-form-1">Search: </label>-->
          <?php print $search_box; ?>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</body>
</html>
