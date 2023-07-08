<?php
$footer_information = get_theme_mod( 'footer_information', false );
if ( $footer_information ): ?>
    <div id="origamiez-footer-copyright" class="pull-left">
		<?php echo wp_kses( $footer_information, origamiez_get_allowed_tags() ); ?>
    </div>
<?php
endif;