<?php
/**
 * Available variables to print:
 * 
 * Full name: $title
 * First name: $firstname
 * Last name: $lastname
 * Qualifications: $qualifications
 * Location/Office: $location
 * Position/Job title: $position
 * Email: $email
 * Tel: $telephone
 * Mobile: $mobile
 * Fax: $fax
 * URL of the Image: $image_url 
 * Image:  $image_field
 * Profile body: $body
 *
 * The variable: use_legacy_image_vars determines whether or not this site is making use of the legacy image variables ($image_url, $thumbnail_url etc) or whether it uses the $image_field variable.  This is mainly relevant to sites who have not over-ridden this template in their theme folder as it is used to decide which code path to follow and this which variables to use.  When over-riding in the theme folder, much of this logic and legacy code can be removed.
 * 
 * URL to the full profile: $node_url
 */

// *** Staff profile image variable *** //
// From 03/08/10 a new variable is available $image_field, this will contain markup generated according to the cck field display settings for the profile image field

// For example if the setting for the teaser display is "thumbnail image linked to node" then in the teaser section below, 
// $image_field will return an <a> tag whose href is the node url and whose content is the teaser sized image
// If the setting for the body display is "detail image" then in the page section the $image_field will return an <img> tag whose src is the detail sized image

// We are still keep the old variables available ($image_exists $image_url, $thumbnail_url, $thumbnail_exists) for any sites that use them, but all sites
// from this point forward should just use the $image_field variable and modify the cck field settings to determine the output.

if ($page) {

  if(!$status) {
    print '<div class="node-unpublished unpublished-staff">';
    print '<div class="unpublished">unpublished</div>';
  }

  print "<div class='row'>";
  print "<div class='col-xs-12 col-sm-4'>";
    if ($image_field) {
      print $image_field;
      //print '<div class="col-xs-12 col-sm-4"><img src="/' . $image_field . '" title="' . $title . '" class="img-thumbnail" alt="' . $staff_alt_text .'"></div>';
    }
  print '</div>';
  print '<div class="col-xs-12 col-sm-8">';
  if ($qualifications)   
  print "<p class='profile-qual'><strong>Qualifications:</strong> $qualifications</p>";
  if ($office_location)
    print "<p class='profile-location'><strong>Location:</strong> $office_location</p>";
  if ($position)
    print "<p class='profile-position'><strong>Position:</strong> $position</p>";
  if ($email)
    print "<p><strong>Email:</strong> <a href='mailto:$email' class='email-address-wrap'>$email</a></p>";
  if ($telephone)
    print "<p><strong>Tel:</strong> $telephone</p>";
  if ($mobile)
    print "<p><strong>Mobile:</strong> $mobile</p>";
  if ($fax)
    print "<p><strong>Fax:</strong> $fax</p>";    
  print '</div>'; // close .profile-info   
  print '</div>'; // close .row   
   print '<hr>';
  if ($body) 
    print "<div id='profile-body'>$body</div>";
  if ($expert_terms)
    //print '<h2>Expertise</h2>';
  if ($expert_terms)
    //print $expert_terms;

  if(!$status) {
   print '</div>';
  }

} 
else {
    print "<div class='profile'>";
    //print '<div>';
    if ($image_field) { 
        print "<div class='staff-image'> <a href='$node_url'> $image_field </a></div>";
    ?>
   
 <?php
    //print '<div class="profile-content">'; 
    print "<div class='title'><a href='$node_url' title='$title'>$title</a></div>";
    if ($position)
      print "<div class='position'>$position</div>";
    print "<p><a href='$node_url' title='View profile, $title'>View more</a></p>";
    print '</div>';
    //print '</div>';
    //print '</div>';

}
}

