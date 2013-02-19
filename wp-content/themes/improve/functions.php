<?php
/*****
 *** Create shortcodes for easy code highlighting
 *****/
function improve_csharp_highlighting($atts, $content = null) {
    return '<pre lang="csharp">' . $content . '</pre>';
}
add_shortcode('csharp', 'improve_csharp_highlighting');



/*****
 *** Wrap inserted images in a div to enable proper sizing with shadow
 *****/
function improve_change_inserted_img_code($html, $id, $alt, $title, $align, $url, $size) {
    return "<div class='imgwrapper'><div>$html</div></div>";
}
add_filter('image_send_to_editor', 'improve_change_inserted_img_code', 10, 7);



/*****
 *** Disable wpautop and wptexturize
 *****/
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');



/*****
 *** Add additional valid attributes to TinyMCE
 *****/
function improve_change_mce_options($init) {
    $ext = 'pre[id|name|class|style|escaped|parse|lang]';

    if (isset($init['extended_valid_elements'])) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    return $init;
}
add_filter('tiny_mce_before_init', 'improve_change_mce_options');



/***** Increase excerpt length *****/
function improve_excerpt_length($length) {
	return 80;
}
add_filter('excerpt_length', 'improve_excerpt_length', 999);
?>