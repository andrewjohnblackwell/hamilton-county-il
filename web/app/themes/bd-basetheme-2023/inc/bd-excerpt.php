<?php

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
    return 60;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

function new_excerpt_more($more)
{
    return ' <a href="' . get_the_permalink() . '"><strong>read more...</strong></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
