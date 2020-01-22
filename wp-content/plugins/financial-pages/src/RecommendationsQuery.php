<?php
namespace FinancialPages;

class RecommendationsQuery extends \WP_Query {

	public function __construct($stock_slug) {
		parent::__construct([
			'post_type' => 'stock-recommendation',
			'tax_query' => [
				[
					'taxonomy' => 'stock',
					'field' => 'slug',
					'terms' => get_query_var('stock'),
				],
			],
			'nopaging' => true,
		]);
	}

}
