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
 * responsds to shortcodes like: [krpano tour="tour1"]
 * and returns the proper code to include the panorama
 */

function krpano($args) {
  $tour_path = tour_path($args['tour']);
  ob_start()
?>
<div id="pano" style="width:<?php echo $args['width']; ?>px; height:<?php echo $args['height']; ?>px;"></div>
  <script src="<?php echo $tour_path; ?>/tour.js"></script>
  <script>
    embedpano({swf:"<?php echo $tour_path; ?>/tour.swf", xml:"<?php echo $tour_path; ?>/tour.xml", target:"pano"});
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

add_shortcode('krpano', 'krpano');
?>
