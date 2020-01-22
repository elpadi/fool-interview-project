<?php
namespace FinancialPages;

use WordpressLib\Widgets\Widget;

class CompanyInfo extends Widget {

	public function __construct() {
		// register widget with WordPress.
		parent::__construct(
			'company_info', // slug
			'Company Info', // title
			'Displays some basic information about a company based on stock exchange name.'// description'
		);
	}

	protected function getFormFields($instance) {
		return [
			$this->formField('stock_symbol', $instance),
		];
	}

	protected static function sanitizeStockSymbol($stock_symbol) {
		$parts = explode(':', $stock_symbol);
		return trim(end($parts));
	}

	public static function fetchProfile($stock_symbol) {
		return \WP_DEBUG ? [
			"symbol" => "AAPL",
			"profile" => [
				"price" => 318.73,
				"beta" => "1.228499",
				"volAvg" => "26604166",
				"mktCap" => "1.39732202E12",
				"lastDiv" => "2.92",
				"range" => "151.7-318.74",
				"changes" => 3.49,
				"changesPercentage" => "(+1.11%)",
				"companyName" => "Apple Inc.",
				"exchange" => "Nasdaq Global Select",
				"industry" => "Computer Hardware",
				"website" => "http://www.apple.com",
				"description" => "Apple Inc is designs, manufactures and markets mobile communication and media devices and personal computers, and sells a variety of related software, services, accessories, networking solutions and third-party digital content and applications.",
				"ceo" => "Timothy D. Cook",
				"sector" => "Technology",
				"image" => "https://financialmodelingprep.com/images-New-jpg/AAPL.jpg"
			]
		] : json_decode(file_get_contents("https://financialmodelingprep.com/api/v3/company/profile/".static::sanitizeStockSymbol($stock_symbol)), TRUE);
	}

	public static function fetchPrice($stock_symbol) {
		return \WP_DEBUG ? [
			"symbol" => "AAPL",
			"price" => 318.68
		] : json_decode(file_get_contents("https://financialmodelingprep.com/api/v3/stock/real-time-price/".static::sanitizeStockSymbol($stock_symbol)));
	}

}
