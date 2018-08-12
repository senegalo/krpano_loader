<?php
/**
 * @package krpano_loader
 * @version 0.1.0 
 */
/*
Plugin Name: KRpano Loader
Plugin URI: https://github.com/senegalo/krpano_loader
Description: This is a simple plugin that load KRpano panoramas and gives a sort of interface to be able to get .
Author: Karim Mansour
Version: 0.1.0
*/


/**
 * KRpano Shortcode
 * responsds to shortcodes like: [krpano tour="tour1" width="400" height="300"]
 * tour: the dir name of the tour in the uploads/tours directory
 * width: Optional tour width. Default: 400
 * height: Optional tour heigt. Default: 300
 * returns the proper code to include the panorama
 */

function krpano($args) {
  $args = shortcode_atts( array(
    'width' => '400',
    'height' => '300',
    'tour' => null
  ), $args);
  $tour_path = tour_path($args['tour']);
  ob_start()
?>
<div id="pano" style="width:<?php echo $args['width']; ?>px; height:<?php echo $args['height']; ?>px;"></div>
  <script src="<?php echo plugin_url(); ?>/krpano_tour_manager.js"></script>
  <script src="<?php echo $tour_path; ?>/tour.js"></script>
  <script>
    embedpano({
      swf:"<?php echo $tour_path; ?>/tour.swf",
      xml:"<?php echo $tour_path; ?>/tour.xml",
      target:"pano",
      onready:function(krpano){
        new KRPanoTourManager(krpano);
      }
    });
  </script>
<?php
  return ob_get_clean();
}

/**
 * Returns the tour root path.
 * Assumes that the tours are stored in the uploads/tours
 */
function tour_path($tour_name){
  return wp_upload_dir(null, false)["baseurl"]."/tours/".$tour_name;
}

function plugin_url() {
  return plugins_url()."/krpano_loader";
}

/**
 * Adds a content that will be hidden at start and then visible
 * by javascript when the specific scene ID is displayed
 */

function scene_content($attr, $content) {
  ob_start();
  ?>
  <div id="<?php echo $attr['name']; ?>" class="krpano-tour-content" style="display:none;"> <?php echo $content; ?> </div>
  <?php

  return ob_get_clean();
}

add_shortcode('krpano', 'krpano');
add_shortcode('krpano_scene', 'scene_content');
?>
