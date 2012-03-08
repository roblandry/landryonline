<?php
// Check if working copy is the latest.

// Get theme Data
  $suri = get_stylesheet_directory_uri();
  $base_url = get_bloginfo('wpurl') . '/wp-content/themes/';
  $slength = strlen($base_url);
  $theme_name = substr($suri, $slength); 
  $theme_data = get_theme_data( get_theme_root() . '/' . $theme_name . '/style.css' );
  $local_version = $theme_data['Version'];
  $theme_author = $theme_data['Author'];
//  $local_version = '0.2';

// Call Function
  if ( current_user_can('manage_options') ) landryonline_check_version($theme_author,$theme_name,$local_version); 

  function landryonline_getinfo($theme_name)
  {
      $checkfile = 'http://trac.landryonline.com/trac.fcgi/export/head/'. $theme_name .'/trunk/check.chk';
      $status = array();
      $vcheck = wp_remote_fopen($checkfile);
      if ($vcheck) {
          
          $status = explode('@', $vcheck);

          return $status;
      }
  }
  
  function landryonline_check_version($theme_author,$theme_name,$local_version)
  {
      if ($theme_author == 'Bigrob8181') {

          $status = landryonline_getinfo($theme_name);
          
          $theVersion = $status[1];
          $theMessage = $status[3];

          if ((version_compare(strval($theVersion), strval($local_version), '>') == 1)) {
              $msg = 'Latest version available: ' . ' <strong>' . $theVersion . '</strong>. ' . $theMessage;
              echo '<div class="plugin-update" style="text-align:center; background-color: #fff; background-color: rgba(255,255,255,0.8); color:red;">' . $msg . '</div>';
          } else {
              return;
          }
      }
  }
?>
