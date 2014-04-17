<?php
/*
Plugin Name: LibDig plugin
Plugin URI: http://www.flocktogether.org.uk/blog/2008/10/09/libdig-wordpress-plug-in/
Description: Used to add a LibDig box to Wordpress posts. Please deactive and delete since <a href="http://libdig.co.uk/gone.html">the LibDig service is discontinued</a>.
Version: 0.6
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
function libdig_admin_notice() {
    ?>
    <div class="update-nag">
        <p><?php echo '<a href="http://libdig.co.uk/gone.html">The LibDig service has been discontinued</a>. Please <a href="'.admin_url().'plugins.php#libdig-plugin">go to the plug-ins page to deactivate and delete the LibDig plug-in</a>.'; ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'libdig_admin_notice' );
?>