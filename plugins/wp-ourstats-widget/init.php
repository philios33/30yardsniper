<?php
/*
 * Plugin Name:   WP ourSTATS Widget
 * Plugin URI:    http://onlinewebapplication.com/2011/10/wp-ourstats-widget.html
 * Description:   STATS.de - the free statistics counter without registration. This plugin create a widget for the ourstats.de counter service that display the ourSTATS counter code on specified pages.
 * Version:       2.1
 * Author:        Pankaj Jha
 * Author URI:    http://onlinewebapplication.com/
 *
 * License:       GNU General Public License, v2 (or newer)
 * License URI:  http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * This program was modified from  ourSTATS Widget plugin, version 1.2.1, 
 * Copyright 2010  Florian Rauscher  (f.rauscher@casibus.de), released under the GNU General Public License.
*/
class wp_ourstats extends WP_Widget {
	function wp_ourstats() {
		$widget_ops = array('classname' => 'wp_ourstats', 'description' => 'Create widgets that display the ourSTATS counter code on specified pages.' );
		$this->WP_Widget('wp_ourstats', 'WP ourSTATS Widget', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$hide = false;
		if(is_preview()) {
			$hide = true;
		} else if(current_user_can('level_10') && $instance['hide_is_admin'] == 'hide' ) {
			$hide = true;
		}
		
		if($hide == false) {
			echo $before_widget;
			$widget_title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
			$ourstats_id = empty($instance['ourstats_id']) ? '&nbsp;' : apply_filters('widget_ourstats_id', $instance['ourstats_id']);
			$ourstats_color = empty($instance['ourstats_color']) ? '&nbsp;' : apply_filters('widget_ourstats_color', $instance['ourstats_color']);
			if ( $widget_title != '' && $widget_title != '&nbsp;' ) { echo $before_title . $widget_title . $after_title; };		
			echo '<ul class="ourstats-widget"><li><script src="http://logging.ourstats.de/js.php?ID='.$ourstats_id.'&amp;style='.$ourstats_color.'" type="text/javascript"></script><noscript><a href="http://stats.ourstats.de/?ID='.$ourstats_id.'" target="_blank"><img src="http://logging.ourstats.de/logging.php?ID='.$ourstats_id.'&amp;js=0&amp;style='.$ourstats_color.'" alt="ourSTATS.de - kostenloser Statistik Counter" border="0" /></a></noscript></li></ul>';
			echo $after_widget;
		}
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['hide_is_admin'] = strip_tags($new_instance['hide_is_admin']);
		$instance['ourstats_id'] = strip_tags($new_instance['ourstats_id']);
		$instance['ourstats_color'] = strip_tags($new_instance['ourstats_color']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ourstats_id' => '', 'ourstats_color' => 'red_grey' ) );
		$title = strip_tags($instance['title']);
		$hide_is_admin = strip_tags($instance['hide_is_admin']);
		$ourstats_id = strip_tags($instance['ourstats_id']);
		$ourstats_color = strip_tags($instance['ourstats_color']);
                $checked[$ourstats_color] = 'checked';
		$admin_checked[$hide_is_admin] = 'checked';
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('ourstats_id'); ?>">ourSTATS ID: <input class="widefat" id="<?php echo $this->get_field_id('ourstats_id'); ?>" name="<?php echo $this->get_field_name('ourstats_id'); ?>" type="text" value="<?php echo attribute_escape($ourstats_id); ?>" /></label></p>
			<p style="margin-top:-10px;float:right;"><a href="http://www.ourstats.de/?get-the-id=1" target="_blank">get the ID</a></p>
			<p><input name="<?php echo $this->get_field_name('hide_is_admin'); ?>" type="checkbox" value="hide" <?php echo $admin_checked['hide']; ?> /> Hide if is Admin</p>
			<p><label for="<?php echo $this->get_field_id('ourstats_color'); ?>">Button Color:
				<p>
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="red" <?php echo $checked['red']; ?> type="radio"><img src="http://www.ourstats.de/buttons/red_grey.gif" style="margin-bottom:-4px;">
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="blue" <?php echo $checked['blue']; ?> type="radio"><img src="http://www.ourstats.de/buttons/blue_grey.gif" style="margin-bottom:-4px;">
				</p>
				<p>
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="green" <?php echo $checked['green']; ?> type="radio"><img src="http://www.ourstats.de/buttons/green_grey.gif" style="margin-bottom:-4px;">
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="olive" <?php echo $checked['olive']; ?> type="radio"><img src="http://www.ourstats.de/buttons/olive_grey.gif" style="margin-bottom:-4px;">
				</p>
				<p>
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="yellow" <?php echo $checked['yellow']; ?> type="radio"><img src="http://www.ourstats.de/buttons/yellow_grey.gif" style="margin-bottom:-4px;">
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="purple" <?php echo $checked['purple']; ?> type="radio"><img src="http://www.ourstats.de/buttons/purple_grey.gif" style="margin-bottom:-4px;">
				</p>
				<p>
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="rose" <?php echo $checked['rose']; ?> type="radio"><img src="http://www.ourstats.de/buttons/rose_grey.gif" style="margin-bottom:-4px;">
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="orange" <?php echo $checked['orange']; ?> type="radio"><img src="http://www.ourstats.de/buttons/orange_grey.gif" style="margin-bottom:-4px;">
				</p>
				<p>
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="slate" <?php echo $checked['slate']; ?> type="radio"><img src="http://www.ourstats.de/buttons/slate_grey.gif" style="margin-bottom:-4px;">
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="wheat" <?php echo $checked['wheat']; ?> type="radio"><img src="http://www.ourstats.de/buttons/wheat_grey.gif" style="margin-bottom:-4px;">
				</p>
				<p>
				    <input name="<?php echo $this->get_field_name('ourstats_color'); ?>" value="random" <?php echo $checked['random']; ?> type="radio"><img src="http://www.ourstats.de/buttons/random.gif" style="margin-bottom:-4px;"> random
				</p>
			</label></p>
				
<?php
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("wp_ourstats");') );

?>
