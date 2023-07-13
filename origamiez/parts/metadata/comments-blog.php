<i class="fa fa-comments-o"></i>
<?php
comments_popup_link(
	esc_attr__( 'No Comment', 'origamiez' ),
	esc_attr__( '1 Comment', 'origamiez' ),
	esc_attr__( '% Comments', 'origamiez' ),
	'metadata-comment',
	esc_attr__( 'Comment Closed', 'origamiez' )
); 