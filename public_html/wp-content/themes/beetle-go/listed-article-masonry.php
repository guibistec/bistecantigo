<?php
global $mokaine;

$blog_excerpts = $mokaine['enable-excerpts'];
$big_post_option = $mokaine['enable-first-post-big'];

$grid_class = ' three';
$thumb_class = '';

if( has_post_thumbnail() && $big_post_option && is_first_post() ) {
    $grid_class = ' six';
}

if ( has_post_thumbnail() ) {
    $thumb_class = 'w-thumb';
} else {
    $thumb_class = 'no-thumb';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'item column' . $grid_class ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>

        <a href="<?php the_permalink(); ?>">

            <figure>

                <?php echo resized_thumbnail( 640, 480, true, false, true ); ?>

                <?php if( has_post_thumbnail() && $big_post_option && is_first_post() ) echo '<div class="gradient"></div>'; ?>

                <span class="blog-overlay"><i class="linecon-icon-<?php mokaine_icons(); ?>"></i></span>

            </figure>

        </a>

    <?php endif; ?>

    <div class="blog-excerpt <?php esc_attr_e( $thumb_class ) ?>">

        <div class="blog-excerpt-inner">

            <?php if( has_post_thumbnail() && $big_post_option && is_first_post() ) { ?>

                <?php mokaine_meta_header_big_masonry_post(); ?>

                <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

            <?php } else { ?>

                <?php mokaine_meta_header(); ?>

                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                <?php

                if ( function_exists( 'has_excerpt' ) && has_excerpt() && $blog_excerpts ) {

                    the_excerpt();

                } else {

                    the_content( __( 'Continue reading ...', MOKAINE_THEME_NAME ) );

                }

                ?>

            <?php } ?>

        </div><!-- blog-excerpt --> 

    </div><!-- blog-excerpt-inner -->  

</article>  