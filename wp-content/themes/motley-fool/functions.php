<?php

$shared_args = array(
	'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
	'after_title'   => '</h2>',
	'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
	'after_widget'  => '</div></div>',
);

register_sidebar(array_merge($shared_args, [
	'name' => 'Financial Sidebar',
	'id' => 'financial',
	'description' => 'Widgets in this area will be displayed in the sidebar of financial pages.',
]));

if (!is_admin() && function_exists('financial_pages_company_info_widget')) {

	// add company info widget
	add_action('dynamic_sidebar_before', function($id, $hasWidgets) {
		if ($id == 'financial') {
			financial_pages_company_info_widget();
		}
	}, 200, 2);

}

add_action('wp_enqueue_scripts', function() {

	$enqueue = function($id, $path, $type, $deps=[]) {
		$url = get_stylesheet_directory_uri()."/assets/{$type}/{$path}.{$type}";
		$file = get_stylesheet_directory()."/assets/{$type}/{$path}.{$type}";
		if ($type == 'js') {
			wp_enqueue_script($id, $url, $deps, filemtime($file), false);
		}
		if ($type == 'css') {
			wp_enqueue_style($id, $url, $deps, filemtime($file));
		}
	};

	wp_localize_script('twentytwenty-js', 'APP_CONFIG', apply_filters('frontend_js_vars', [
		'DEBUG' => WP_DEBUG,
		'HEADERS' => getallheaders(),
	]));

	if (function_exists('financial_pages_post_has_company_info')) {

		if (financial_pages_post_has_company_info()) {
			$enqueue('company-info', 'company-info', 'js');
		}

	}

}, 100);

