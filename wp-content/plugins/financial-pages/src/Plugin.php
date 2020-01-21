<?php
namespace FinancialPages;

use WordpressLib\Plugins\Plugin as BasePlugin;

class Plugin extends BasePlugin {

	protected $articleType;
	protected $recommendationType;
	protected $stockTax;

	public function __construct() {
		parent::__construct();

		// company info widget
		$companyInfoClassName = __NAMESPACE__.'\\CompanyInfo';
		add_action('widgets_init', function() use ($companyInfoClassName) {
			register_widget($companyInfoClassName);
		});
	}

	public function init() {

		// news article type
		$this->articleType = new NewsArticle();
		$this->articleType->register();

		// stock recommendation type
		$this->recommendationType = new StockRecommendation();
		$this->recommendationType->register();

		// stock taxonomy
		$this->stockTax = new StockTaxonomy();
		$this->stockTax->register([$this->articleType->slug, $this->recommendationType->slug]);

	}

}
