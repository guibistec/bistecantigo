<?php
// Get item terms                   
$terms = wp_get_post_terms( $post->ID, 'project-tags', array( 'fields' => 'slugs' ) );
$list_categories = NULL;

if ( !empty( $terms ) ) {
    foreach ( $terms as $term ) {
        $list_categories[] .= '"' . $term . '"';
    }
    $joined_categories = join( ', ', $list_categories );
}

// Get global variables (some inherited from section-portfolio.php)
global $grid_class, $portfolio_mosaic, $in_lightbox, $sc_lightbox;

// Serve the right thumbnail size
$thumb_size = resized_thumbnail( 640, 480, true, false, true );

if ( $portfolio_mosaic ) { 
    $thumb_size = resized_thumbnail( 640, null, null, false, true );
}
?>

<article id="item-<?php the_ID(); ?>" <?php post_class( 'item column ' . $grid_class ); ?> data-groups='[<?php esc_attr_e( $joined_categories ); ?>]'>

    <figure><?php echo $thumb_size; ?></figure>

    <?php if ( $in_lightbox || $sc_lightbox == 'true' ) : ?>

        <?php $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

        <a class="overlay" href="<?php echo esc_url( $image_attributes[0] ) ?>">

    <?php else : ?>

        <a class="overlay" href="<?php the_permalink(); ?>">

    <?php endif; ?>

        <div class="overlay-content">

        <?php if ( $in_lightbox || $sc_lightbox == 'true' ) : ?>

            <div class="post-type"><i class="linecon-icon-search"></i></div>

        <?php else : ?>

            <div class="post-type"><i class="linecon-icon-<?php mokaine_icons(); ?>"></i></div>

        <?php endif; ?>        

            <h2><?php the_title(); ?></h2>

        </div><!-- overlay-content -->

    </a><!-- overlay -->

</article>