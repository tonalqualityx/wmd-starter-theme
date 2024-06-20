<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies<?php defined( 'ABSPATH' ) or die( 'Sectumsempra!' );//For enemies


function ind_minifier($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s'          // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);
    $buffer = preg_replace('/<!--[\s\S]*?-->/', '', $buffer); // Remove HTML comments

    return $buffer;
}

/**
 * Retrieves all published posts, sorts them in alphabetical order by title,
 * and returns an array of key-value pairs where the key is the post ID and the value is the post title.
 *
 * If the transient "wmd_all_posts_list" is set, the function retrieves the posts list from the transient.
 * If the transient is not set, the function uses get_posts to get the posts, saves the array to the transient,
 * and stores it for 1 year.
 *
 * @return array The array of key-value pairs where the key is the post ID and the value is the post title.
 */
function wmd_get_all_posts_list() {

    $transient_name = 'wmd_all_posts_list';
    $posts_list = get_transient($transient_name);

    if (false === $posts_list) {
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => -1,
        );

        $posts = get_posts($args);

        $posts_list = array();
        foreach ($posts as $post) {
            $posts_list[$post->ID] = $post->post_title;
        }

        set_transient($transient_name, $posts_list, 365 * DAY_IN_SECONDS);
    }

    return $posts_list;
}

/**
 * Clears the specified transients whenever a post is saved.
 *
 * All transients with the prefix wmd_ will be cleared on post save
 *
 * @param int $post_id The ID of the post being saved.
 */
function wmd_clear_transients_on_post_save($post_id) {

    global $wpdb;

    $prefix = '_transient_wmd_';

    $transients = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT option_name FROM $wpdb->options WHERE option_name LIKE %s",
            $wpdb->esc_like($prefix) . '%'
        )
    );

    foreach ($transients as $transient) {
        delete_transient(str_replace('_transient_', '', $transient));
    }
}
add_action('save_post', 'wmd_clear_transients_on_post_save');


function maybe_px($input) {
    // Check if the input is numeric or ends with a CSS unit
    if (is_numeric($input)) {
        // If it's numeric, append 'px' to it
        return $input . 'px';
    } else if (preg_match('/(em|ex|%|px|cm|mm|in|pt|pc|ch|rem|vh|vw|vmin|vmax)$/i', $input)) {
        // If it ends with a CSS unit, return it as is
        return $input;
    } else {
        // If it's neither, return false or handle as needed
        return false;
    }
}

function wmd_css_rule( $selector, $rule, $value ) {
    return $selector . '{ ' . $rule . ':' . $value . ';}';
}


function wmd_hexToRgba($hex, $opacity){
    $hex = str_replace("#", "", $hex);
    $r = $g = $b = 0;

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
    } else if(strlen($hex) == 6) {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    $rgba = 'rgba(' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ')';
    return $rgba;
}

function wmd_get_custom_logo() {
    // Get the ID of the custom logo.
    $custom_logo_id = get_theme_mod('custom_logo');
    // Get the image source, width, and height.
    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
    // Get the URL of the image.
    $logo_url = $image[0];
    // Get the width and height of the image.
    $width = $image[1];
    $height = $image[2];
    // Calculate the aspect ratio of the image.
    $aspect_ratio = $height / $width * 100;
    // Get the URL of the site.
    $site_url = get_site_url();

    // Start output buffering.
    ob_start();
    ?>
    <div id="logo-container"><div class="custom-logo-link"><a href="<?php echo $site_url; ?>" rel="home" aria-current="page" style="display: block; width: 100%; height: 0; padding-bottom: <?php echo $aspect_ratio; ?>%; position: relative;">
        <span style="background: url(<?php echo $logo_url; ?>) no-repeat center center; background-size: contain; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></span>
    </a></div></div>
    <?php
    // End output buffering and return the result.
    return ob_get_clean();
}


add_filter('show_admin_bar', '__return_false');


function secondsToHumanReadable($seconds) {
    
    if (!is_numeric($seconds)) {
        throw new InvalidArgumentException('The $seconds parameter must be a number.');
    }

    $dtF = new \DateTime();
    $dtF->setTimestamp(0);  // Set the date/time to the Unix epoch

    $dtT = new \DateTime();
    $dtT->setTimestamp($seconds);

    $diff = $dtF->diff($dtT);

    $format = [];
    if ($diff->y) $format[] = "%yy";
    if ($diff->m) $format[] = "%mm";
    if ($diff->d) $format[] = "%dd";
    if ($diff->h) $format[] = "%hh";
    if ($diff->i) $format[] = "%im";
    if ($diff->s) $format[] = "%ss";

    // Only take the 3 most significant units
    $format = array_slice($format, 0, 3);

    return $diff->format(implode(', ', $format));
}


function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}


