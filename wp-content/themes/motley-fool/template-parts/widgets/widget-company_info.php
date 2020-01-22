<?php
if (isset($stock_data)) printf('<script>window.STOCK_COMPANY_INFO = %s;</script>', json_encode($stock_data));
?>
<section class="company-info" data-stock-symbol="<?= $stock_symbol; ?>" data-info-type="profile" data-stock-url="<?= financial_pages_get_stock_url($stock_symbol); ?>">
	<header>
		<!-- INSERT LOGO HERE -->
		<h3 class="company-info__field" data-key="companyName" data-format="stockurl"></h3>
		<p><strong>Exchange:</strong> <span class="company-info__field" data-key="exchange"></span></p>
	</header>
	<main>
		<p class="company-info__field" data-key="description"></p>
		<p><strong>Industry:</strong> <span class="company-info__field" data-key="industry"></span></p>
		<p><strong>Sector:</strong> <span class="company-info__field" data-key="sector"></span></p>
		<p><strong>CEO:</strong> <span class="company-info__field" data-key="ceo"></span></p>
		<p><strong>URL:</strong> <span class="company-info__field url" data-key="website" data-format="url"></span></p>
	</main>
</section>
