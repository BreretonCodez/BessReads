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
    <br>
    <div class="row">
        <h1>Popular Books</h1>
        <hr>
            <?php
            $pop_books = new WP_Query(array(
                'post_type' => 'book',
                'posts_per_page' => 6,
                'orderby' => 'avgRating',
                'order' => 'DESC',

            ));
            if ($pop_books->have_posts()) :
                while ($pop_books->have_posts()) : $pop_books->the_post(); ?>
                    <div class="col sm-2 book">
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
        <!-- Add other sections for Popular Books, Book Genres, etc. -->
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
                    'taxonomy' => 'category', // Replace 'category' with the name of your taxonomy if it's different
                    'hide_empty' => false, // Show categories with no posts
                ));

                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body text-center">';
                        echo '<h5 class="card-title"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . $category->name . '</a></h5>';
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
</div>

<?php get_footer(); ?>