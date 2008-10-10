<?php
/*
Plugin Name: LibDig plugin
Plugin URI: http://www.flocktogether.org.uk/blog/2008/10/09/libdig-wordpress-plug-in/
Description: Adds a Lib Dig box to Wordpress posts and pages
Version: 0.3
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

function addLibDigBox($content) {
	global $wp_query;
	$post 		= $wp_query->post;
	$permalink 	= urlencode(get_permalink($post->ID));	
	$title 		= urlencode($post->post_title);
	$title	 	= str_replace('+','%20',$title);
	$f 			= 'left';
	$digScript = '<script type="text/javascript" src="http://libdig.co.uk/widget.php?f='.urlencode($f).'&amp;u='.$permalink.'&amp;t='.$title.'"></script>';
	if(!is_page() && !is_feed()):
		$content = $digScript.$content;
	endif;
	return($content);
}

?>