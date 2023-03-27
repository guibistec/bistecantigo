<?php
/**
 * Some helper funcions
 */

/* Spot first post */
function is_first_post() {
    global $wp_query;
    if( $wp_query->current_post == 0 && !is_paged() ) return true;
    return false;
}

/* Query theme's post type */
function what_mokaine_post_type( $type ) {
    global $wp_query;
    if( $type == get_post_type( $wp_query->post->ID ) ) return true;
    return false;
}

/* Spot theme's portfolio post */
function is_mokaine_portfolio_post() {
    return get_post_type() == 'portfolio';
}

/* Spot theme's portfolio post page */
function get_mokaine_portfolio_post_page( $post_id ) {
    global $wpdb;
    
    $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
    WHERE meta_key='_wp_page_template' AND meta_value='template-portfolio.php' ORDER BY post_id DESC"); // "Order by DESC" returnes the portfolio page with lower ID

    foreach ($results as $result) {
        $page_id = $result->post_id;
    }
    
    return $page_id;
}

/* Get portfolio pages list */
function get_mokaine_portfolio_pages() {
    return get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-portfolio.php' ) );
}

/* Get homepage page */
function get_mokaine_home_page() {
    return end( get_pages( array( 'number' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-home.php' ) ) );
}

/* Get meta values */
function get_meta( $type, $value ) {
    return isset( $type[ $value ] ) && ! empty( $type[ $value ] ) ? $type[ $value ] : false;
}

/* Helper function for mokaine shortcode generator conditional */
function is_edit_page( $new_edit = null ) {

    global $pagenow;

    //make sure we are on the backend
    if ( !is_admin() ) return false;

    if( $new_edit == 'edit' )

        return in_array( $pagenow, array( 'post.php',  ) );

    elseif( $new_edit == 'new' ) //check for new post page

        return in_array( $pagenow, array( 'post-new.php' ) );

    else //check for either new or edit

        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
        
}