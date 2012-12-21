<?php
/*
Plugin Name:Custom WP Login Page
Plugin URI: http://w3effects.com
Description:This is simple and easy configrable Plugin which Replaces the default login logo and styles of the WP Login Page
Version:1.0
Author: Pankaj Adhyapak
Author URI: http://pankajadhyapak.me
License: GPL2
*/

/* Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function my_login_logo1() { ?>


    <style type="text/css">
        body.login div#login h1 a {
            background-image: url("<?php echo esc_attr(get_option('powered_by_image'));?>");
            padding-bottom: 50px;
            background-size:256px 100px;
            }
       .login form {
            background:#<?php echo get_option('powered_by_color');?>;
            -webkit-border-radius: 12px;
            -o-border-radius: 12px;
            -moz-border-radius: 12px;
             border-radius: 12px;
            }
       .login label {color: #<?php echo get_option('powered_by_textcolor');?>; }
	  
    </style>
<?php }
function plugin_avtivation(){
update_option('powered_by_image',plugins_url('logo5.png',__FILE__) ); 
update_option('powered_by_color','278AB7'); 
update_option('powered_by_textcolor','ffffff'); }
register_activation_hook(__FILE__,"plugin_avtivation");

function my_login_logo1_url1() {
    return home_url(); 
;
}
add_filter( 'login_headerurl', 'my_login_logo1_url1' );

function my_login_logo1_url1_title1() {
    return get_bloginfo('name')." - ". get_bloginfo('description');
}
add_filter( 'login_headertitle', 'my_login_logo1_url1_title1' );


function wpcoustom_option_page(){


if(isset($_POST['upload_image_powered'] )){
update_option('powered_by_image',$_POST['upload_image_powered']); 
update_option('powered_by_color',$_POST['poweredbycolor']); 
update_option('powered_by_textcolor',$_POST['poweredbytextcolor']); 

  echo '<div style="height:22px;  padding:10px;" id="message" class="updated">Settings saved successfully.</div>';
  }
  if(isset($_POST['wplogin_reset'] )){
update_option('powered_by_image',plugins_url('logo5.png',__FILE__) ); 
update_option('powered_by_color','278AB7'); 
update_option('powered_by_textcolor','ffffff'); 

  echo '<div style="height:22px;  padding:10px;" id="message" class="updated">Setting Reseted.</div>';
  }
?>
<script language="JavaScript">
jQuery(document).ready(function() {
jQuery('#upload_image_powered_button').click(function() {
formfield = jQuery('#upload_image_powered').attr('name');
tb_show('', 'media-upload.php?type=image&TB_iframe=true');
return false;
});

window.send_to_editor = function(html) {
imgurl = jQuery('img',html).attr('src');
jQuery('#upload_image_powered').val(imgurl);
tb_remove();
}

});


</script>

<div class='wrap'>
<?php screen_icon(); ?>
<h2><em>Custom WP Login Setting</em></h2>
<h3><em>Choose Image to display in login page</em></h3><br/>
	
	<form method="post" id="wp-login-plugin">
<input id="upload_image_powered" type="text" size="36" name="upload_image_powered" value="<?php echo esc_attr(get_option('powered_by_image'));?>" />
		<input id="upload_image_powered_button" type="button" value="Choose Image" /><br/>
		<h3><em>Choose Login Box Color :<em></h3>
			<span style="color:#999; font-size:1.9em;">Pick Color &#8594;</span><input class="color" name="poweredbycolor" id="poweredbycolor" value="<?php echo esc_attr(get_option('powered_by_color'));?>">
			<h3><em>Choose Login Box Text-Color :<em></h3>
			<span style="color:#999; font-size:1.9em;">Pick Color &#8594;</span><input class="color" name="poweredbytextcolor" id="poweredbytextcolor" value="<?php echo esc_attr(get_option('powered_by_textcolor'));?>">
		
<p><input type="submit" name="submit" value="save Changes" />&nbsp;   
 
</p>
		<br />
		

		</form>
		
		<form method="post" id="wp-login-plugin">
		<input type="submit" name="wplogin_reset" value="Reset Settings" onclick="return alert('Are you Sure?')"/>
		</form>

	</td>
</tr>
<?php
}


function wp_gear_manager_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('jscolor');

wp_enqueue_script('thickbox');
wp_enqueue_script('jquery');
}

function wp_gear_manager_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');

function coustomwp_admin_menu1(){
wp_enqueue_script('the_js', plugins_url('/js/jscolor.js',__FILE__) );

add_options_page('Custom WP Login ','Custom WP Login','manage_options','powered-by-plugin','wpcoustom_option_page');

}
add_action('admin_menu','coustomwp_admin_menu1');
add_action( 'login_enqueue_scripts', 'my_login_logo1' );

?>