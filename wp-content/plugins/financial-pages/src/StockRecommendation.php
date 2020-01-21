<?php
namespace FinancialPages;

use WordpressLib\Posts\CustomType;

class StockRecommendation extends CustomType {

	public function __construct() {
		parent::__construct('stock-recommendation');
	}

}
