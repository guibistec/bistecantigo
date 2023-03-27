<?php
global $mokaine;

$blog_excerpts = $mokaine['enable-excerpts'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear-after' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>

        <div class="column three">

            <figure>

                <a href="<?php the_permalink(); ?>">

                    <?php echo resized_thumbnail( 640, 640, true, false, true ); ?>

                </a>

            </figure>
            
        </div><!-- column three -->

        <div class="column nine last">

    <?php else : ?>

        <div class="column twelve last">        

    <?php endif; ?>

            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

            <?php mokaine_meta_header(); ?>

            <div class="entry-content">

                <?php

                if ( function_exists( 'has_excerpt' ) && has_excerpt() && $blog_excerpts ) {

                    the_excerpt();

                } else {

                    the_content( __( 'Continue reading ...', MOKAINE_THEME_NAME ) );

                }

                ?>

                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . __( 'Pages:', MOKAINE_THEME_NAME ),
                        'after'  => '</div>',
                    ) );
                ?>

            </div><!-- entry-content -->

        </div><!-- column -->

</article>