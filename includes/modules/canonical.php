<?php
//添加canonical标签
function suxingme_archive_link( $paged = true ) {
        $link = false;
  
        if ( is_front_page() ) {
                $link = home_url( '/' );
        } else if ( is_home() && "page" == get_option('show_on_front') ) {
                $link = get_permalink( get_option( 'page_for_posts' ) );
        } else if ( is_tax() || is_tag() || is_category() ) {
                $term = get_queried_object();
                $link = get_term_link( $term, $term->taxonomy );
        } else if ( is_post_type_archive() ) {
                $link = get_post_type_archive_link( get_post_type() );
        } else if ( is_author() ) {
                $link = get_author_posts_url( get_query_var('author'), get_query_var('author_name') );
        } else if ( is_archive() ) {
                if ( is_date() ) {
                        if ( is_day() ) {
                                $link = get_day_link( get_query_var('year'), get_query_var('monthnum'), get_query_var('day') );
                        } else if ( is_month() ) {
                                $link = get_month_link( get_query_var('year'), get_query_var('monthnum') );
                        } else if ( is_year() ) {
                                $link = get_year_link( get_query_var('year') );
                        }                                               
                }
        }
  
        if ( $paged && $link && get_query_var('paged') > 1 ) {
                global $wp_rewrite;
                if ( !$wp_rewrite->using_permalinks() ) {
                        $link = add_query_arg( 'paged', get_query_var('paged'), $link );
                } else {
                        $link = user_trailingslashit( trailingslashit( $link ) . trailingslashit( $wp_rewrite->pagination_base ) . get_query_var('paged'), 'archive' );
                }
        }
        return $link;
}

?>