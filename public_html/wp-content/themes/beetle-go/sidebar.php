<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside role="complementary" class="sidebar column three last">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</aside>
