<?php
/*
 * Template Name: Page Magazine
 */

get_header();
?>

<div id="sidebar-center" class="pull-left origamiez-size-01">

	<?php get_sidebar('main-top'); ?>

	<div class="row clearfix">
	
		<div class="col-sm-9 col-xs-12 pull-right">

			<?php get_sidebar('main-center-top'); ?>

			<div class="row clearfix">
				<div class="col-sm-6 col-xs-12">
					<?php get_sidebar('main-center-left'); ?>
				</div>

				<div class="col-sm-6 col-xs-12">
					<?php get_sidebar('main-center-right'); ?>
				</div>
			</div>
			
			<?php get_sidebar('main-center-bottom'); ?>			
		</div>		

		<div class="col-sm-3 col-xs-12 pull-left">			
			<?php get_sidebar('left'); ?>
		</div>		

	</div>

	<?php get_sidebar('main-bottom'); ?>

</div>

<?php get_sidebar('right'); ?>

<div class="clearfix"></div>

<?php get_sidebar('bottom'); ?>

<div class="clearfix"></div>

<?php
$footer_number_of_cols = (int)get_theme_mod('footer_number_of_cols', 5);
get_footer($footer_number_of_cols);
