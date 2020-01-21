<?php
namespace FinancialPages;

use WordpressLib\Posts\CustomTaxonomy;

class StockTaxonomy extends CustomTaxonomy {

	public function __construct() {
		parent::__construct('stock');
	}

}
