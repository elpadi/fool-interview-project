<?php
namespace FinancialPages;

use WordpressLib\Posts\CustomType;

class NewsArticle extends CustomType {

	public function __construct() {
		parent::__construct('news-article');
	}

}
