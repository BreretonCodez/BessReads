<?php
get_header();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <?php
            // Get the current author object
            $author = get_userdata(get_query_var('author'));
            if ($author) :
                ?>
                <div class="author-info">
                    <h2><?php echo esc_html($author->display_name); ?></h2>
                    <div class="author-avatar">
                        <?php echo get_avatar($author->ID, 150, '', '', array('class' => 'img-fluid rounded-circle')); ?>
                    </div>
                    <br>
                    <h4>Author Bio:</h4>
                    <div class="author-bio">
                        <p><?php echo esc_html($author->description); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <h2><?php echo esc_html($author->display_name); ?>'s Books</h2>
            <div class="row">
                <?php
                // Query for books authored by the current author
                $author_books = new WP_Query(array(
                    'post_type' => 'book',
                    'author' => $author->ID,
                    'posts_per_page' => -1,
                ));

                // Check if the query has any posts
                if ($author_books->have_posts()) :
                    while ($author_books->have_posts()) : $author_books->the_post();
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                </a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No books found.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>