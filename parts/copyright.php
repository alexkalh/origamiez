<?php 
$footer_information = get_theme_mod('footer_information', false);
if ($footer_information): ?>
    <div id="origamiez-footer-copyright" class="pull-left">
        <?php echo htmlspecialchars_decode(esc_html($footer_information)); ?>
    </div>
<?php
endif;