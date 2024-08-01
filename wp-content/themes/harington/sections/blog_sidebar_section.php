			<?php if( is_active_sidebar( 'harington-blog-sidebar' ) ){ ?>
			<!-- Sidebar -->
			<div id="black-fade"></div>

			<div id="sidebar">
				<div id="open-sidebar" class="link"><i class="fa-solid fa-arrow-left"></i></div>

				<div id="scrollbar"></div>
				<div class="sidebar-content">

					<?php dynamic_sidebar( 'harington-blog-sidebar' ); ?>

				</div>

			</div>
			<!--/Sidebar -->
			<?php } ?>