<?php
/**
 * @package FinancialPages
 */
/*
Plugin Name: Motley Fool Financial Pages
Plugin URI: https://fool.com/
Description: Widgets, Custom Post Types, and Taxonomies used for news articles and stock recommendations.
Version: 1.0.0
Author: Carlos Padilla
Author URI: https://github.com/elpadi/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2020 Carlos Padilla
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require_once( __DIR__ . '/vendor/autoload.php' );

call_user_func(function() {
	$plugin = FinancialPages\Plugin::instance();
	register_activation_hook( __FILE__, [$plugin, 'onActivation']);
	register_deactivation_hook( __FILE__, [$plugin, 'onDeactivation']);
});

function financial_pages_get_stock_symbol_from_post($_post=null) {
	global $post;
	$terms = get_the_terms($_post ? $_post : $post, 'stock');
	return ($terms && count($terms)) ? current($terms)->name : '';
}

function financial_pages_get_stock_url($name) {
	return get_term_link($name, 'stock');
}

function financial_pages_company_info_widget() {
	the_widget('FinancialPages\\CompanyInfo', ['stock_symbol' => financial_pages_get_stock_symbol_from_post()]);
}

function financial_pages_post_has_company_info($post=null) {
	return (bool)financial_pages_get_stock_symbol_from_post($post);
}

add_action('pre_get_posts', function($query) {

	if (!is_admin() && is_tax('stock') && $query->is_main_query()) {
		// only have news articles in main query, 10 per page.
		$query->set('post_type', 'news-article');
		$query->set('posts_per_page', 10);
	}

});

