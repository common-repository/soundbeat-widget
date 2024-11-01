<?php
/*
Plugin Name: SoundBeat Widget
Plugin URI: http://soundbeat.org/widget/
Description: SoundBeat Audio Player Widget
Version: 1.0
Author: Syracuse University Library
Author URI: http://library.syr.edu/
License: GPL
*/
 
class SoundBeatWidget extends WP_Widget {
  function SoundBeatWidget() {
    $widget_ops = array('classname' => 'SoundBeatWidget', 'description' => 'SoundBeat Audio Player');
    $this->WP_Widget('SoundBeatWidget', 'SoundBeat Widget', $widget_ops);
  }
 
  function form($instance) {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
  }
 
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance) {
    
    extract($args, EXTR_SKIP);
    
    echo $before_widget;
    
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title)) {
      echo $before_title . $title . $after_title;;
    }
    
 		if ($_SERVER['HTTPS'] == "on") { 
 		  $url = "https://soundbeat.org/widget/wordpress.php";
 		} else {
 			$url = "http://soundbeat.org/widget/wordpress.php";
 		}
 		
 		echo "<div id=\"SoundBeatWidget_div\">";
 		echo file_get_contents($url);
 		echo "</div>";
 		
    echo $after_widget;
    
  }
}

add_action( 'widgets_init', create_function('', 'return register_widget("SoundBeatWidget");') );

?>