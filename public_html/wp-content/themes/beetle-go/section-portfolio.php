<?php
// Define global variables (some to be used in listed-item.php)
global $mokaine, $grid_class, $portfolio_mosaic, $in_lightbox;

$portfolio_filters = $mokaine['enable-portfolio-filters'];

// Items per page
$portfolio_pagination = get_post_meta( $post->ID, '_mokaine_items_per_page', true );

// Mosaic Layout
$portfolio_mosaic = get_post_meta( $post->ID, '_mokaine_portfolio_mosaic', true );

// Lightbox
$in_lightbox = get_post_meta( $post->ID, '_mokaine_portfolio_lightbox', true );

if ( $portfolio_pagination == -1 ) {
    $portfolio_pagination = -1; // show all items
}

$portfolio_args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => $portfolio_pagination,
    'paged' => ( $i = get_query_var('paged') ) ? $i : 1        
);

$wp_query = new WP_Query( $portfolio_args );

// Define columns classes
$columns_number = get_post_meta( $post->ID, '_mokaine_portfolio_columns_number', true );

$cols = ( $columns_number ) ? $columns_number : 'four' ;

switch ( $cols ) {
    case 'columns-4' :
        $grid_class = 'three';
        break;
    case 'columns-3' :
        $grid_class = 'four';
        break;
    case 'columns-2' :
        $grid_class = 'six';
        break;
}
?>

<section class="row">

    <div class="row-content buffer clear-after">

        <div class="post-area portfolio-section clear-after"> 

            <?php if ( $portfolio_filters ) : ?>

                <ul class="inline cats filter-options">

                    <?php foreach ( get_terms( 'project-tags' ) as $tag ) : ?>
                            
                        <li data-group="<?php esc_attr_e( $tag->slug ); ?>"><?php esc_html_e( $tag->name ) ?></li>
                    
                    <?php endforeach; ?>
                    
                </ul>

            <?php endif; ?>

            <div class="grid-items preload <?php if ( $in_lightbox ) echo 'lightbox'; ?>">

                <?php if ( $wp_query->have_posts() ) : ?>

                    <?php while ( $wp_query->have_posts() ) : ?>
                    
                        <?php $wp_query->the_post(); ?>

                        <?php get_template_part( 'listed', 'item' ); ?>

                    <?php endwhile; ?>

                    <div class="shuffle-sizer <?php esc_attr_e( $grid_class ) ?>"></div>

                <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

                <?php endif; ?>

            </div>

            <?php mokaine_paging_nav(); ?>

        </div><!-- post-area -->

    </div><!-- row-content -->

</section><!-- row -->

<?php wp_reset_postdata(); ?>