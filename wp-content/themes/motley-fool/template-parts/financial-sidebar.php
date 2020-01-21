<div class="financial-widgets-wrapper">

	<div class="financial-sidebar-inner section-inner">

		<aside class="financial-widgets-outer-wrapper" role="complementary">

			<div class="financial-widgets-wrapper">

				<div class="financial-widgets column-one grid-item"><?php

					if (isset($stock_data)) {
						if (is_tax('stock')) {
							include(__DIR__.'/widgets/widget-company_finances.php');
						}
					}
					else dynamic_sidebar('financial');

				?></div>

			</div><!-- .financial-widgets-wrapper -->

		</aside><!-- .financial-widgets-outer-wrapper -->

	</div><!-- .footer-inner -->

</div><!-- .footer-nav-widgets-wrapper -->
