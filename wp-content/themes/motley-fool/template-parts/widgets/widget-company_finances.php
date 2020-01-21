<?php
if (isset($stock_data)) printf('<script>window.STOCK_COMPANY_INFO = %s;</script>', json_encode($stock_data));
?>
<section class="company-info" data-stock-symbol="<?= $stock_symbol; ?>" data-info-type="finances">
	<main>
		<p><strong>Price:</strong> <span class="company-info__field" data-key="price" data-format="money"></span></p>
		<p><strong>Price Change:</strong> <span class="company-info__field" data-key="changes" data-format="money"></span></p>
		<p><strong>Price Change (Percentage):</strong> <span class="company-info__field" data-key="changesPercentage"></span></p>
		<p><strong>52 Week Range:</strong> <span class="company-info__field" data-key="range" data-format="money-range"></span></p>
		<p><strong>Beta:</strong> <span class="company-info__field" data-key="beta"></span></p>
		<p><strong>Volume Average:</strong> <span class="company-info__field" data-key="volAvg"></span></p>
		<p><strong>Market Capitalisation:</strong> <span class="company-info__field" data-key="mktCap"></span></p>
		<p><strong>Last Dividend:</strong> <span class="company-info__field" data-key="lastDiv" data-format="money"></span></p>
	</main>
</section>
