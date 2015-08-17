<?php
/* https://api.drupal.org/api/drupal/modules!system!theme.api.php/group/themeable/7 */

/**
 * Implemetation of hook theme_breadcrumb
 **/
function fd_purplemonkey_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $crumbs = '<ul class="breadcrumbs">';
    foreach($breadcrumb as $value) {
      $crumbs .= '<li>'.$value.'</li>';
    }
    $crumbs .= '</ul>';
    return $crumbs;
  }
}

/**
 * Implementation of theme_menu_tree
 * Add foundation friendly classes to the menu tree
 **/
function fd_purplemonkey_menu_tree__main_menu($variables) {
  // This feels like there should be a better way
  if (strpos($variables['tree'], 'has-dropdown') !== false) {
    $output = '<ul class="menu">' . $variables['tree'] . '</ul>';
  }
  else {
    $output = '<ul class="menu">' . $variables['tree'] . '</ul>';
  }
  return $output;
}

function fd_purplemonkey_menu_tree_sub($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}


/**
 * Implementation of theme_menu_link
 * Add foundation friendly classes to the menu tree
 **/
function fd_purplemonkey_menu_link__main_menu(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
    // Add the foundation nav sub-menu thingy
    // It may be better to use #original_link['has_children'] - not tested
    $element['#attributes']['class'][] = 'has-dropdown';
  }

  // AE: Place an active class on the list-item that is in the active trail
  if ($element['#original_link']['in_active_trail']) {
    $element['#attributes']['class'][] = 'active';
  }

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implementation of hook function theme_menu_local_tasks
 * Essentially.. the tab navigation
 **/
function fd_purplemonkey_menu_local_tasks(&$variables) {
  // dpm($variables);
  $output = '';

    if (!empty($variables['primary'])) {
      $variables['primary']['#prefix']  = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
      $variables['primary']['#prefix'] .= '<nav id="tab-navigation">';
      $variables['primary']['#prefix'] .= '<ul class="tabs primary primary-tabs clearfix">';
      $variables['primary']['#suffix']  = '</ul>';
      // AE: Check if we need to close the <nav> tag
      if (empty($variables['secondary'])) {
        $variables['primary']['#suffix']  .= '</nav><!-- #tab-navigation -->';
      }
      $output .= drupal_render($variables['primary']);
    }
    if (!empty($variables['secondary'])) {
      $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
      $variables['secondary']['#prefix'] .= '<ul class="tabs secondary secondary-tabs clearfix">';
      $variables['secondary']['#suffix']  = '</ul>';
      // AE: Close the <nav> tag as well
      $variables['secondary']['#suffix'] .= '</nav><!-- #tab-navigation -->';
      $output .= drupal_render($variables['secondary']);
    }
    return $output;
}

/**
 * Implementation of hook_theme_links()
 * Need to render expanded menus for Foundation to manually create Foundation nav bar features
 **/
function fd_purplemonkey_links($variables) {
  if (array_key_exists('id', $variables['attributes']) && $variables['attributes']['id'] == 'main-menu-links') {
    $pid = variable_get('menu_main_links_source', 'main-menu');
    $tree = menu_tree($pid);
    // dpm($tree);
    $attributes = array(
      'class' => array('template-php'),
    );
    return drupal_render($tree);
  }
  return theme_links($variables);
}

function fd_purplemonkey_js_alter(&$javascript) {
  // Swap out JQuery to use the bundled with Foundation-edition
  // $javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'fd_purplemonkey') . '/bower_components/foundation/js/vendor/jquery.js';
  // $javascript['misc/jquery.js']['scope'] = 'footer';
  //  dpm($javascript);
}

/**
 * Implements hook_preprocess_page().
 */
function fd_purplemonkey_preprocess_page(&$vars, $hook) {
  $options = array(
    'scope' => 'footer',
  );
  drupal_add_js(drupal_get_path('theme', 'fd_purplemonkey') .'/bower_components/foundation/js/vendor/jquery.js', $options);
  drupal_add_js(drupal_get_path('theme', 'fd_purplemonkey') .'/bower_components/foundation/js/vendor/modernizr.js', $options);
  drupal_add_js(drupal_get_path('theme', 'fd_purplemonkey') .'/bower_components/foundation/js/vendor/fastclick.js', $options);
  drupal_add_js(drupal_get_path('theme', 'fd_purplemonkey') .'/bower_components/foundation/js/foundation.min.js', $options);
  drupal_add_js(drupal_get_path('theme', 'fd_purplemonkey') . '/js/app.js', $options);
}

/**
 * Implements hook_preprocess_html()
 * Using drupal_add_html_head() to add meta tags to header
 */
function fd_purplemonkey_preprocess_html (&$vars) {
  $element = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1.0',
    ),
  );

  drupal_add_html_head($element, 'elements');
}
