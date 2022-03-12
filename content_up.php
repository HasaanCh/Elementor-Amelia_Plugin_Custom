<?php
/**
 * Plugin Name: Amelia Customer Upload
 * Description: Amelia Customer Upload Using Excel
 * 
 */

 function create_admin_menu()
 {
    add_menu_page( 'Content', 'Excel Upload', 'manage_options', 'content_upload_menu', 'content_upload_menu_main', 'dashicons-admin-generic', 2 );
 }

 add_action( 'admin_menu', 'create_admin_menu' );

 

 function content_upload_menu_main()
 {

   echo '<div class="wrap"><h2>Please upload your excel file here.</h2></div>';
   $content='';
   $content .= '<form method="post" action="'.plugin_dir_url(__FILE__).'process/" enctype="multipart/form-data">';
   $content .= '<input type="file" name="excel_file" id="excel_file"/>';
   $content .= '<input type="submit" name="content_submitted" value="Submit"/>';
   $content .= '</form>';

   echo  $content;


 }

?>