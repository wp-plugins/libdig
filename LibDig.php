<?php
/*
Plugin Name: LibDig plugin
Plugin URI: http://www.flocktogether.org.uk/blog/2008/10/09/libdig-wordpress-plug-in/
Description: Adds a Lib Dig box to Wordpress posts. <a href="themes.php?page=libdigoptions">Edit options</a>.
Version: 0.4
Author: Martin Tod
Author URI: http://www.martintod.org.uk
*/
/*  Copyright 2008  Martin Tod  (email : martin@martintod.org.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
add_filter('the_content','addLibDigBox');
add_action('admin_menu','libdig_add_pages');
function libdig_add_pages() {
	add_theme_page('LibDig plugin settings', 'LibDig', 8, 'libdigoptions', 'showLibDigOptions');
}
function addLibDigBox($content) {
    // variables for the field and option names 
    $opt_name = 'libdig_float';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	if(empty($opt_val)):
	   $opt_val = 'left';
       update_option( $opt_name, $opt_val );	
	endif;
	
	global $wp_query;
	$post 		= $wp_query->post;
	$permalink 	= urlencode(get_permalink($post->ID));	
	$title 		= urlencode($post->post_title);
	$title	 	= str_replace('+','%20',$title);
	$f 			= $opt_val; 
	$digScript = '<script type="text/javascript" src="http://libdig.co.uk/widget.php?f='.urlencode($f).'&amp;u='.$permalink.'&amp;t='.$title.'"></script>';
	if(!is_page() && !is_feed()):
		$content = $digScript.$content;
	endif;
	return($content);
}
function showLibDigOptions() {

    // variables for the field and option names 
    $opt_name = 'libdig_float';
    $hidden_field_name = 'libdig_submit_hidden';
    $data_field_name = 'libdig_leftorright';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Option saved.', 'libdig_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'LibDig Plugin Options', 'libdig_trans_domain' ) . "</h2>";

    // options form
    
    ?>

<form name="libdig_form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
<?php
$checked ='checked="checked" ';
if($opt_val != 'right'):
	$leftchecked = $checked;unset($rightchecked);
else:
	$rightchecked = $checked;unset($leftchecked);
endif;
?>
<p><?php _e("Which side of the post do you wish to show the LibDig button?", 'libdig_question' ); ?></p>
<input name="<?php echo $data_field_name; ?>" id="radioleft" type="radio" accesskey="l" tabindex="1" value="left" <?php echo $leftchecked;?> />
<label for="radioleft"><?php _e("left", 'libdig_left' ); ?></label>
<p>
  <input name="<?php echo $data_field_name; ?>" type="radio" id="radioright" value="right" accesskey="r" tabindex="2" <?php echo $rightchecked;?> />
  <label for="radioright"><?php _e("right", 'libdig_right' ); ?></label>
</p>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p>

</form>
</div>

<?php

}

?>