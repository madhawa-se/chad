<?php

function framework_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $string));
  // If the first character is not a-z, add 'id' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id' . $string;
  }
  return $string;
}

/**
 * Implementation of preprocess_page().
 */
function chadwick_theme_preprocess_page(&$vars, $hook) {

  if (!module_exists('conditional_styles')) {
    $vars['styles'] .= $vars['conditional_styles'] = variable_get('conditional_styles_' . $GLOBALS['theme'], '');
  }

  // Update jQuery
  if (arg(0) != 'admin') {
    $scripts = drupal_add_js();

    // Use Google for jQuery
    $vars['head'] .= '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';

    unset($scripts['core']['misc/jquery.js']);
    $vars['scripts'] = drupal_get_js('header', $scripts);
  }


  /**
   * Site information variables from /admin/settings/site-information
   */

  // Website info
  $vars['site_name'] = variable_get('site_name', '');
  $vars['site_mail'] = variable_get('site_mail', '');
  $vars['site_slogan'] = variable_get('site_slogan', '');
  $vars['site_mission'] = variable_get('site_mission', '');
  $vars['site_footer'] = variable_get('site_footer', '');

  // Company VAT and Registration Information
  $vars['company_vatno'] = variable_get('company_vatno', '');
  $vars['company_regno'] = variable_get('company_regno', '');
  $vars['company_regloc'] = variable_get('company_regloc', '');

  // Primary Company Location
  $vars['company_address1'] = variable_get('company_address1', '');
  $vars['company_address2'] = variable_get('company_address2', '');
  $vars['company_address3'] = variable_get('company_address3', '');
  $vars['company_city'] = variable_get('company_city', '');
  $vars['company_county'] = variable_get('company_county', '');
  $vars['company_postcode'] = variable_get('company_postcode', '');
  $vars['company_country'] = variable_get('company_country', '');
  $vars['company_phone'] = variable_get('company_phone', '');
  $vars['company_alt_number'] = variable_get('company_phone2', '');
  $vars['company_fax'] = variable_get('company_fax', '');
  $vars['company_mobile'] = variable_get('company_mobile', '');
  $vars['company_pager'] = variable_get('company_pager', '');
  
  if (isset($vars['node'])) {
    $n = $vars['node'];
    $vars['strap'] = $n->field_banner_strapline[0]['value'];
  }
  
  if (isset($vars['node'])) {
    $n = $vars['node'];
    $vars['strapline'] = $n->field_strapline[0]['value'];
  }
  
  if (isset($vars['node'])) {
    $n = $vars['node'];
    $vars['elevator'] = $n->field_elevator_pitch[0]['value'];
  }
  
  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  $classes = split(' ', $vars['body_classes']);
  // Remove the mostly useless page-ARG0 class.
  if ($index = array_search(preg_replace('![^abcdefghijklmnopqrstuvwxyz0-9-_]+!s', '', 'page-'. drupal_strtolower(arg(0))), $classes)) {
    unset($classes[$index]);
  }
  if (!$vars['is_front']) {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    $classes[] = framework_id_safe('page-' . $path);
    
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        $section = 'node-add';
        $classes[] = framework_id_safe('section-' . $section);
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        $section = 'node-' . arg(2);
        $classes[] = framework_id_safe('section-' . $section);
      }
      
    }
    
    $template_files = array();
    foreach ($vars['template_files'] as $file) {
      $template_files[] = $file;
      if ($file == 'page-node') {
        $template_files[] = 'page-'. $vars['node']->type;
      }
    }
    $vars['template_files'] = $template_files;
    
    // Add unique class for each website section.
    $sections = explode('/', $path);
    for ($i = 0; $i < count($sections); $i++) {
      $count = 0;
      $class = 'section-';
      for ($count; $count <= $i; $count++) {
        $class .= $sections[$count];
        if ($count < $i) {
          $class .= '-';
        }
      }

      $classes[] = framework_id_safe($class); 
    }
  }
  $vars['body_classes_array'] = $classes;
  $vars['body_classes'] = implode(' ', $classes); // Concatenate with spaces.
 
  $vars['tabs2'] = menu_secondary_local_tasks();

}






/**
 * Override theme_breadrumb().
 *
 * Print breadcrumbs as an ordered list.
 */
function chadwick_theme_breadcrumb($breadcrumb) {

  if (!empty($breadcrumb)) {
    $title = '<li class="active">' . drupal_get_title() . '</li>';
    $breadcrumbs = '<ol class="breadcrumb">';
    $count = count($breadcrumb) - 1;
    foreach ($breadcrumb as $key => $value) {
      if ($count != $key) {
        $breadcrumbs .= '<li>' . $value . '</li>';
      }
      else{
        $breadcrumbs .= '<li>' . $value . '</li>';
      }
    }
    $breadcrumbs .= $title;
    $breadcrumbs .= '</ol>';
    return $breadcrumbs;
  }
}


/**
 * Override theme_menu_local_tasks().
 *
 * Format tabs wrapper to match Bootstrap.
 */
function chadwick_theme_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="nav nav-tabs primary">' . $primary . '</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="nav nav-pills secondary">' . $secondary . '</ul>';
  }

  return $output;
}

/**
 * chadwick_theme_preprocess_search_theme_form().
 */
function chadwick_theme_preprocess_search_theme_form(&$vars, $hook) {
  // Amend the label of the search form (setting it blank removes it)
  $vars['form']['search_theme_form']['#title'] = t('Search');
 
  // Add a custom class and placeholder to the search box
  $vars['form']['search_theme_form']['#attributes'] = array('class' => 'form-control','placeholder' => 'Search');
 
  // Uncomment the line below to change the text on the submit button, changing Go as required.
  //$vars['form']['submit']['#value'] = t('Go');

  // Rebuild the rendered version (search form only, rest remains unchanged)
  unset($vars['form']['search_theme_form']['#printed']);
  $vars['search']['search_theme_form'] = drupal_render($vars['form']['search_theme_form']);

  // uncomment the two lines below to change the button to an image, custom the path and name of the image as required.
  //$vars['form']['submit']['#type'] = 'image_button';
  //$vars['form']['submit']['#attributes'] = array('alt' => t('Search'));
  //$vars['form']['submit']['#src'] = path_to_theme() . '/images/search.jpg';

  // Rebuild the rendered version (submit button, rest remains unchanged)
  unset($vars['form']['submit']['#printed']);
  $vars['search']['submit'] = drupal_render($vars['form']['submit']);

  // Collect all form elements to make it easier to print the whole form.
  $vars['search_form'] = implode($vars['search']);
}


/**
 * Override form_element().
 */
function chadwick_theme_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();
  
  if ($element['#type'] == 'checkbox') {
    $output = '<div class="checkbox">';
  } elseif ($element['#type'] == 'radio') {
    $output = '<div class="radio">';
  } else {
    $output = '<div class="form-group">';
  };
  $required = !empty($element['#required']) ? '<span class="form-required" title="' . $t('This field is required.') . '">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="' . $element['#id'] . '">' . $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) . "</label>\n";
    }
    else {
      $output .= ' <label>' . $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) . "</label>\n";
    }
  }

  $output .= " $value\n";

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">' . $element['#description'] . "</div>\n";
  }

  $output .= "</div>\n";
  return $output;
  
}

/**
 * Override theme_textfield().
 */
function chadwick_theme_textfield($element) {
  // Add bootstrap classes
  $class = array('form-control');

  if ($element['#autocomplete_path'] && menu_valid_path(array('link_path' => $element['#autocomplete_path']))) {
    $class[] = 'form-autocomplete';
    $extra = '<input class="autocomplete" type="hidden" id="' . $element['#id'] . '-autocomplete" value="' . check_url(url($element['#autocomplete_path'], array('absolute' => TRUE))) . '" disabled="disabled" />';
  }

  _form_set_class($element, $class);

  $maxlength = empty($element['#maxlength']) ? '' : ' maxlength="' . $element['#maxlength'] . '"';
  $size = empty($element['#size']) ? '' : ' size="' . $element['#size'] . '"';

  if (isset($element['#field_prefix'])) {
    $output = '<span class="prefix">' . $element['#field_prefix'] . '</span> ';
  }
  
  $output .= '<input type="text"' . $maxlength . ' name="' . $element['#name'] . '" id="' . $element['#id'] . '"' . $size . ' value="' . $element['#value'] . '" ' . drupal_attributes($element['#attributes']) . ' />';

  if (isset($element['#field_suffix'])) {
    $output .= ' <span class="suffix">' . $element['#field_suffix'] . '</span>';
  }
  
  return theme('form_element', $element, $output);
}

/**
 * Override theme_textfield().
 */
function chadwick_theme_webform_email($element) {
  // Add bootstrap classes
  $class = array('form-control');

  if ($element['#autocomplete_path'] && menu_valid_path(array('link_path' => $element['#autocomplete_path']))) {
    $class[] = 'form-autocomplete';
    $extra = '<input class="autocomplete" type="hidden" id="' . $element['#id'] . '-autocomplete" value="' . check_url(url($element['#autocomplete_path'], array('absolute' => TRUE))) . '" disabled="disabled" />';
  }

  _form_set_class($element, $class);

  $maxlength = empty($element['#maxlength']) ? '' : ' maxlength="' . $element['#maxlength'] . '"';
  $size = empty($element['#size']) ? '' : ' size="' . $element['#size'] . '"';
  
  if (isset($element['#field_prefix'])) {
    $output = '<span class="prefix">' . $element['#field_prefix'] . '</span> ';
  }
  
  $output .= '<input type="text"' . $maxlength . ' name="' . $element['#name'] . '" id="' . $element['#id'] . '"' . $size . ' value="' . $element['#value'] . '" ' . drupal_attributes($element['#attributes']) . ' />';

  if (isset($element['#field_suffix'])) {
    $output .= ' <span class="suffix">' . $element['#field_suffix'] . '</span>';
  }
  
  return theme('form_element', $element, $output);
}

/**
 * Override theme_textarea().
 */
function chadwick_theme_textarea($element) {
  
  $class = array('form-control');

  // Add teaser behavior (must come before resizable)
  if (!empty($element['#teaser'])) {
    drupal_add_js('misc/teaser.js');
    // Note: arrays are merged in drupal_get_js().
    drupal_add_js(array('teaserCheckbox' => array($element['#id'] => $element['#teaser_checkbox'])), 'setting');
    drupal_add_js(array('teaser' => array($element['#id'] => $element['#teaser'])), 'setting');
    $class[] = 'teaser';
  }

  _form_set_class($element, $class);
  return theme('form_element', $element, '<textarea cols="' . $element['#cols'] . '" rows="' . $element['#rows'] . '" name="' . $element['#name'] . '" id="' . $element['#id'] . '" ' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>');
}

/**
 * Override theme_password().
 */
function chadwick_theme_password($element) {
  $size = $element['#size'] ? ' size="' . $element['#size'] . '" ' : '';
  $maxlength = $element['#maxlength'] ? ' maxlength="' . $element['#maxlength'] . '" ' : '';

  $class = array('form-control');
  _form_set_class($element, $class);

  $output = '<input type="password" name="' . $element['#name'] . '" id="' . $element['#id'] . '" ' . $maxlength . $size . drupal_attributes($element['#attributes']) . ' />';
  return theme('form_element', $element, $output);
}

/**
 * Override theme_select().
 */
function chadwick_theme_select($element) {
  $class = array('form-control','form-select');
  $select = '';
  $size = $element['#size'] ? ' size="' . $element['#size'] . '"' : '';
  _form_set_class($element, $class);
  $multiple = $element['#multiple'];
  return theme('form_element', $element, '<select name="' . $element['#name'] . '' . ($multiple ? '[]' : '') . '"' . ($multiple ? ' multiple="multiple" ' : '') . drupal_attributes($element['#attributes']) . ' id="' . $element['#id'] . '" ' . $size . '>' . form_select_options($element) . '</select>');
}

/**
 * Override theme_checkbox().
 */
function chadwick_theme_checkbox($element) {
  _form_set_class($element, array('form-checkbox'));
  $checkbox = '<input ';
  $checkbox .= 'type="checkbox" ';
  $checkbox .= 'name="' . $element['#name'] . '" ';
  $checkbox .= 'id="' . $element['#id'] . '" ';
  $checkbox .= 'value="' . $element['#return_value'] . '" ';
  $checkbox .= $element['#value'] ? ' checked="checked" ' : ' ';
  $checkbox .= drupal_attributes($element['#attributes']) . ' />';

  if (!is_null($element['#title'])) {
    $checkbox = '<label class="option" for="' . $element['#id'] . '">' . $checkbox . ' ' . $element['#title'] . '</label>';
  }

  unset($element['#title']);
  return theme('form_element', $element, $checkbox);
}

/**
 * Override theme_button().
 */
function chadwick_theme_button($element) {
  if (check_plain($element['#value']) == 'Delete' || check_plain($element['#value']) == 'Reset') {
    // Not sure how else to target specific buttons
    $chadwick_theme_btn_class = 'btn-danger';
  }
  else {
    $chadwick_theme_btn_class = 'btn-primary';
  }
  // Make sure not to overwrite classes.
  if (isset($element['#attributes']['class'])) {
    $element['#attributes']['class'] = 'btn ' . $chadwick_theme_btn_class . ' form-' . $element['#button_type'] . ' ' . $element['#attributes']['class'];
  }
  else {
    $element['#attributes']['class'] = 'btn ' . $chadwick_theme_btn_class . ' form-' . $element['#button_type'];
  }

  return '<input type="submit" ' . (empty($element['#name']) ? '' : 'name="' . $element['#name'] . '" ') . 'id="' . $element['#id'] . '" value="' . check_plain($element['#value']) . '" ' . drupal_attributes($element['#attributes']) . " />\n";
}
