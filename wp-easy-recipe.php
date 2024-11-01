<?php
/*
Plugin Name: WP Easy Recipe
Description: "WP Easy Recipe" is a very simple plugins for manage the recipe content on your site. 
Version: 1.6
Text Domain: wpexpersin
Author: WP Experts Team
Author URI: https://www.wp-experts.in
*/
/*  Copyright 2015- 2023  wp-easy-recipe  (email : raghunath.0087@gmail.com)

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
/* 
* Setup Admin menu item 
*/
//"WP Easy Recipe" Admin Menu Item
add_action('admin_menu','wp_easy_recipe_menu');

function wp_easy_recipe_menu(){

	//add_options_page('WP Easy Recipe','WP Easy Recipe','manage_options','wp-easy-recipe-plugin','wp_easy_recipe_admin_option_page');
	add_submenu_page('edit.php?post_type=wp_easy_recipe','WP Easy Recipe Settings Page','Settings','manage_options','wper-settings','wp_easy_recipe_admin_option_page');

}

//Define Action for register "WP Easy Recipe" Options
add_action('admin_init','wp_easy_recipe_init');

/** add js into admin footer */
add_action('admin_enqueue_scripts','init_wer_admin_scripts');
if(!function_exists('init_wer_admin_scripts')):
function init_wer_admin_scripts() {
wp_register_style( 'wer_admin_style', plugins_url( 'css/wer-admin.css',__FILE__ ) );
wp_enqueue_style( 'wer_admin_style' );
 $script='	jQuery(document).ready(function(){
		jQuery(".wer-tab").hide();
		jQuery("#div-wer-general").show();
	    jQuery(".wer-tab-links").click(function(){
		var divid=jQuery(this).attr("id");
		jQuery(".wer-tab-links").removeClass("active");
		jQuery(".wer-tab").hide();
		jQuery("#"+divid).addClass("active");
		jQuery("#div-"+divid).fadeIn();
		})
		}) ';
wp_add_inline_script( 'jquery-core', $script );
	}	
endif;	

//Register "WP Easy Recipe" options
function wp_easy_recipe_init(){

	register_setting( 'wp_easy_recipe_options', 'wpe_shareBtns', 'sanitize_text_field');
	register_setting( 'wp_easy_recipe_options', 'wpe_dothtml', 'sanitize_text_field' );
} 

// Add settings link to plugin list page in admin
if(!function_exists('wer_add_plugin_settings_link')):
function wer_add_plugin_settings_link( $links ) {
            $settings_link = '<a href="edit.php?post_type=wp_easy_recipe&page=wper-settings">' . __( 'Settings', 'wer' ) . '</a>';
            array_unshift( $links, $settings_link );
            return $links;
  }
endif;
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'wer_add_plugin_settings_link' );

/* Options Form */
function wp_easy_recipe_admin_option_page(){ ?>
	<div> 
	<h2>WP Easy Recipe Settings :</h2>
	<p>Please fill all options value.</p>
	<!-- Start Options Form -->
	<form action="options.php" method="post" id="rg-sidebar-admin-form">
	<div id="wer-tab-menu"><a id="wer-general" class="wer-tab-links active" >General</a> <a id="wer-shortcodes" class="wer-tab-links" >Shortcodes</a> <a  id="wer-support" class="wer-tab-links">Support</a> </div>
	<div class="wer-setting">
	<!-- General Setting -->	
	<div class="first wer-tab" id="div-wer-general">
	<table class="wp-easy-recipe">
			<tr>
				<td valign="top">Add HTML Code:<br>
				<textarea type="textarea" id="wpe_shareBtns" name="wpe_shareBtns" rows="10" cols="35"  ><?php echo esc_attr(get_option('wpe_shareBtns')); ?></textarea><br><i>This will display just above of content </i>
				</td>
			</tr>	
			<!--<tr scope="row">
				<td valign="top"><label for="wpe_dothtml"><strong style="font-size:16px;">Add .html in url: </strong></label>
				<select type="textarea" id="wpe_dothtml" name="wpe_dothtml" >
					<option value="no" <?php if(get_option('wpe_dothtml')=='no'){echo 'selected="selected"';} ?>>No</option><option value="yes" <?php if(get_option('wpe_dothtml')=='yes'){echo 'selected="selected"';} ?>>Yes</option></select><br>(<strong>Example:</strong> http://your-domain/recipe/demo.html)
				</td>
				<td valign="top">&nbsp;</td>
				<td valign="top">&nbsp;</td>
			</tr>	-->

			<tr><td colspan="3">&nbsp;</td></tr>		
		</table>
		</div>
	<!-- Support -->
	<div class="last author wer-tab" id="div-wer-shortcodes">
	<h2>Shortcode</h2>
		<p><br>[wp_recipe_list_page] : Use for display all recipe in a single page</p>
	           <p><br><br>[cat_menu catid=""] : Use for get the child category link with thumbnail</p>
	           <p><br><br>[wp_easy_recipe_slider] : Use for add recipe feature images slider</p>
	           <p><br><br>[wer_recipe_of_the_day] :Use for display recipe of the day</p>  
	           <p><br><br>[wer_ten_best_recipe] :Use for display 10 best recipe</p>
	</div>
	<div class="last author wer-tab" id="div-wer-support">
	<h2>Plugin Support</h2>
	<table>
	<tr>
	<td width="50%"><p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZEMSYQUZRUK6A" target="_blank" style="font-size: 17px; font-weight: bold;"><img src="<?php echo  plugins_url( 'images/btn_donate_LG.gif' , __FILE__ );?>" title="Donate for this plugin"></a></p>
	<p><strong>Plugin Author:</strong><a href="https://www.wp-experts.in" target="_blank">WP Experts Team</a></p>
	<p><a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author">Contact Author</a></p></td>
	<td><p><strong>Our Other Plugins:</strong><br>
		<ol>
					<li><a href="https://wordpress.org/plugins/custom-share-buttons-with-floating-sidebar" target="_blank">Custom Share Buttons With Floating Sidebar</a></li>
							<li><a href="https://wordpress.org/plugins/protect-wp-admin/" target="_blank">Protect WP-Admin</a></li>
							<li><a href="https://wordpress.org/plugins/wc-sales-count-manager/" target="_blank">WooCommerce Sales Count Manager</a></li>
							<li><a href="https://wordpress.org/plugins/wp-protect-content/" target="_blank">WP Protect Content</a></li>
							<li><a href="https://wordpress.org/plugins/wp-categories-widget/" target="_blank">WP Categories Widget</a></li>
							<li><a href="https://wordpress.org/plugins/wp-importer" target="_blank">WP Importer</a></li>
							<li><a href="https://wordpress.org/plugins/wp-youtube-gallery/" target="_blank">WP Youtube Gallery</a></li>
							<li><a href="https://wordpress.org/plugins/wp-social-buttons/" target="_blank">WP Social Buttons</a></li>
							<li><a href="https://wordpress.org/plugins/seo-manager/" target="_blank">SEO Manager</a></li>
							<li><a href="https://wordpress.org/plugins/otp-login/" target="_blank">OTP Login</a></li>
							<li><a href="https://wordpress.org/plugins/optimize-wp-website/" target="_blank">Optimize WP Website</a></li>
							<li><a href="https://wordpress.org/plugins/wp-version-remover/" target="_blank">WP Version Remover</a></li>
							<li><a href="https://wordpress.org/plugins/wp-tracking-manager/" target="_blank">WP Tracking Manager</a></li>
							<li><a href="https://wordpress.org/plugins/wp-posts-widget/" target="_blank">WP Post Widget</a></li>
							<li><a href="https://wordpress.org/plugins/optimize-wp-website/" target="_blank">Optimize WP Website</a></li>
							<li><a href="https://wordpress.org/plugins/wp-testimonial/" target="_blank">WP Testimonial</a></li>
							<li><a href="https://wordpress.org/plugins/wp-sales-notifier/" target="_blank">WP Sales Notifier</a></li>
							<li><a href="https://wordpress.org/plugins/cf7-advance-security" target="_blank">Contact Form 7 Advance Security WP-Admin</a></li>
							<li><a href="https://wordpress.org/plugins/wp-easy-recipe/" target="_blank">WP Easy Recipe</a></li>
					</ol></td>
	</tr>
	</table>
	</div>
	</div>
    <span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary','submit','','');?></span>
    <?php settings_fields('wp_easy_recipe_options'); ?>
	</form>
<!-- End Options Form -->
	</div>
<?php 
} 

/*
 * Return all options value
 * */
function get_wp_easy_recipe_options() {
		global $wpdb;
		$ctOptions = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE 'wpe_%'");
								
		foreach ($ctOptions as $option) {
			$ctOptions[$option->option_name] =  $option->option_value;
		}
	
		return $ctOptions;	
	}
/*
  * DEFINE "WP EASY RECIPE" POSTS
*/

//Include wp easy recipe files for manage recipe pages
include dirname( __FILE__ ) .'/lib/class-wp-easy-recipe.php';
/* 
*Delete the options during disable the plugins 
*/
if( function_exists('register_uninstall_hook') )
	register_uninstall_hook(__FILE__,'wp_easy_recipe_uninstall');   
	
//Delete all Custom Tweets options after delete the plugin from admin
function wp_easy_recipe_uninstall(){
	delete_option('wpe_shareBtns');
	delete_option('wpe_dothtml');
} 
