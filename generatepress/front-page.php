<?php
get_header();
?>
<div class="container">
    <div class="row">
        <h1>Latest Books</h1>
        <hr>
            <?php
            $latest_books = new WP_Query(array(
                'post_type' => 'book',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
            ));
            if ($latest_books->have_posts()) :
                while ($latest_books->have_posts()) : $latest_books->the_post(); ?>
                    <div class="col-sm-2 book">
                        <a href="<?php the_permalink(); ?>">
                            <img class="img-fluid rounded" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'home-thumbnail')); ?>" alt="<?php the_title(); ?>">
                        </a>
                    </div>
                <?php endwhile;
            else :
                echo '<p>No latest books found.</p>';
            endif;
            wp_reset_postdata();
            ?>
    </div>
    <br>
    <div class="row">
        <h1>Popular Books</h1>
        <hr>
            <?php
            $pop_books = new WP_Query(array(
                'post_type' => 'book',
                'posts_per_page' => 6,
                'meta_key' => 'rmp_avg_rating',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_query' => array(
                    array(
                        'key' => 'rmp_avg_rating',
                        'compare' => 'EXISTS',
                    ),
                ),
            ));
            if ($pop_books->have_posts()) :
                while ($pop_books->have_posts()) : $pop_books->the_post(); ?>
                    <div class="col-sm-2 book">
                        <a href="<?php the_permalink(); ?>">
                            <img class="img-fluid rounded" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'home-thumbnail')); ?>" alt="<?php the_title(); ?>">
                        </a>
                    </div>
                <?php endwhile;
            else :
                echo '<p>No popular books found.</p>';
            endif;
            wp_reset_postdata();
            ?>
    </div>
    <br>
    <div class="author-spotlight">
        <h1>Author Spotlight</h1>
        <hr>

        <?php
        // Query to retrieve the latest spotlight post
        $spotlight_query = new WP_Query(array(
            'post_type' => 'spotlight',
            'posts_per_page' => 1, // Show only one spotlight post
            'order' => 'DESC',
            'orderby' => 'date',
        ));

        if ($spotlight_query->have_posts()) :
            while ($spotlight_query->have_posts()) : $spotlight_query->the_post();
                // Retrieve custom fields data
                $author_name = get_post_meta(get_the_ID(), 'author_name', true);
                $author_url = get_post_meta(get_the_ID(), 'author_link', true);
                $author_image_id = get_post_meta(get_the_ID(), 'author_image', true);
                $author_image_url = wp_get_attachment_url($author_image_id);
                $author_bio = get_post_meta(get_the_ID(), 'author_bio', true);
                $accolade = get_post_meta(get_the_ID(), 'author_accolade', true);
                $bio = wp_trim_words($author_bio, 30, '');
                ?>

                <div class="spotlight-content card bg-warning-subtle">
                    <div class="row mt-4 mb-4 justify-content-center">
                        <div class="col"></div>
                        <div class="col-md-3">
                            <?php if ($author_image_url) : ?>
                                <img class="img-fluid rounded-circle" src="<?php echo esc_url($author_image_url); ?>" alt="<?php echo esc_attr($author_name); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <h6><?php echo esc_html($accolade); ?></h6>
                            <?php if ($author_name) : ?>
                                <h3><a class="text-black" href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a></h3>
                            <?php endif; ?>
                            <?php if ($author_bio) : ?>
                                <p><?php echo esc_html($bio); ?></p>
                            <?php endif; ?>
                            <div class="btn btn-primary"><a class="text-white" href="<?php the_permalink(); ?>">Read More</a></div>
                        </div>
                        <div class="col"></div>
                    </div>
                    

                    
                </div>

            <?php endwhile;
            wp_reset_postdata(); // Reset post data query
        else :
            echo '<p>No spotlight posts found.</p>';
        endif;
        ?>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h1>Book Genres</h1>
            <hr>
            <br>
            <div class="row">
                <?php
                $categories = get_categories(array(
                    'taxonomy' => 'category',
                    'hide_empty' => false,
                ));

                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body text-center bg-success-subtle">';
                        echo '<h5 class="card-title"><a class="text-black" href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></h5>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-md-12">No categories found.</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <br>
</div>

<?php get_footer(); ?>