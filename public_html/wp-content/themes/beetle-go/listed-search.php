<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear-after' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>

        <div class="column two">

            <figure>

                <a href="<?php the_permalink(); ?>">

                    <?php echo resized_thumbnail( 640, 640, true, false, true ); ?>

                </a>

            </figure>
            
        </div><!-- column three -->

        <div class="column ten last">

    <?php else : ?>

        <div class="column twelve last">        

    <?php endif; ?>

            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if( is_mokaine_portfolio_post() ) : ?>

            	<p class="search-type"><?php echo __( 'Portfolio Item', MOKAINE_THEME_NAME ); ?></p>

            <?php else : ?>

            	<?php if( what_mokaine_post_type( 'post' ) ) : ?>

            		<p class="search-type"><?php echo __( 'Blog Post', MOKAINE_THEME_NAME ); ?></p>

            	<?php elseif( what_mokaine_post_type( 'page' ) ) : ?>

            		<p class="search-type"><?php echo __( 'Page', MOKAINE_THEME_NAME ); ?></p>

            	<?php endif; ?>

            <?php endif; ?>

        </div><!-- column -->

</article>