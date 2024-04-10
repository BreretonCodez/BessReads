<?php
get_header();
?>
<div class="container">
    <div class="row">
        <h1>All Books</h1>
        <hr>
        <br>
            <?php
            $all_books = new WP_Query(array(
                'post_type' => 'book',
                'posts_per_page' => -1,
                'orderby' => 'DESC',
            ));
            if ($all_books->have_posts()) :
                while ($all_books->have_posts()) : $all_books->the_post(); ?>
                    <div class="col sm-2 book">
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
</div>

<?php get_footer(); ?>