<?php

get_header();

if ( have_posts() ){

the_post();

?>

		<!-- Main -->
		<div id="main">

		<?php

			// display hero section, if any
			$harington_hero_properties = new Harington_Hero_Properties();
			$harington_hero_properties->getProperties( get_post_type() );
			if( $harington_hero_properties->enabled ){

				get_template_part('sections/hero_section');
			}

		?>
			<!-- Main Content -->
			<div id="main-content">
				<div id="main-page-content">

					<?php the_content(); ?>

				</div>

				<?php get_template_part('sections/project_navigation_section'); ?>

			</div>
			<!--/Main Content-->

		</div>
		<!-- /Main -->
<?php

}

get_footer();

?>
