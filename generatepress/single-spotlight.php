<?php
get_header(); 
?>
<main>
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

                <div class="spotlight-content card secondary">
                    <div class="row mt-4 mb-4 justify-content-center">
                        <div class="col"></div>
                        <div class="col-md-3">
                            <?php if ($author_image_url) : ?>
                                <img class="img-fluid rounded-circle" src="<?php echo esc_url($author_image_url); ?>" alt="<?php echo esc_attr($author_name); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <h6><?php echo esc_html($accolade); ?></h6>
                            <?php if ($author_name) : ?>
                                <h3><a class="text-black" href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a></h3>
                            <?php endif; ?>
                            <?php if ($author_bio) : ?>
                                <p><?php echo esc_html($author_bio); ?></p>
                            <?php endif; ?>
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
</main>
<?php
get_footer();   
?>