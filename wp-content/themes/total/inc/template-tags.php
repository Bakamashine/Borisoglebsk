<?php

/**
 * Custom template tags for this theme.
 *
 *
 * @package Total
 */
if (!function_exists('total_posted_on')):

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function total_posted_on() {
        $time_string = '<span class="ht-day">%1$s</span><span class="ht-month-year">%2$s %3$s</span>';

        $posted_on = sprintf($time_string, esc_html(get_the_date('d')), esc_attr(get_the_date('M')), esc_html(get_the_date('Y'))
        );

        $byline = sprintf(
            /* translators: author */
            esc_html_x('by %s', 'post author', 'total'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        $comment_count = get_comments_number(); // get_comments_number returns only a numeric value

        if (comments_open()) {
            if ($comment_count == 0) {
                $comments = esc_html__('No Comments', 'total');
            } elseif ($comment_count > 1) {
                $comments = $comment_count . esc_html__(' Comments', 'total');
            } else {
                $comments = esc_html__('1 Comment', 'total');
            }
            $comment_link = '<a href="' . get_comments_link() . '"><i class="far fa-comment" aria-hidden="true"></i> ' . $comments . '</a>';
        } else {
            $comment_link = "";
        }

        echo '<span class="entry-date published updated">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>' . $comment_link; // WPCS: XSS OK.
    }

endif;

if (!function_exists('total_entry_footer')):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function total_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' == get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                printf(// WPCS: XSS OK.
                    /* translators: categories */
                    '<span class="cat-links">' . esc_html__('Posted in %s', 'total') . '</span>', $categories_list);
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                printf(// WPCS: XSS OK.
                    /* translators: tags */
                    '<span class="tags-links">' . esc_html__('Tagged %s', 'total') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(esc_html__('Leave a comment', 'total'), esc_html__('1 Comment', 'total'), esc_html__('% Comments', 'total'));
            echo '</span>';
        }

        edit_post_link(esc_html__('Edit', 'total'), '<span class="edit-link">', '</span>');
    }

endif;

if (!function_exists('total_entry_category')):

    /**
     * Prints HTML with meta information for the categories
     */
    function total_entry_category() {
        // Hide category and tag text for pages.
        if ('post' == get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo '<i class="far fa-bookmark"></i>' . $categories_list; // WPCS: XSS OK.
            }
        }
    }

endif;
