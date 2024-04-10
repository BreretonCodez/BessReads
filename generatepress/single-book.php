<?php
get_header(); 
?>
<main>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="book-info">
                                    <h1 class="entry-title"><strong><?php the_title(); ?></strong></h1>
                                    <h3><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></h3>
                                    <br>
                                    <p> <?php echo get_the_excerpt();  ?> </p>
                                    <p><strong>Genres:</strong> <?php echo get_the_category_list(', '); ?></p>
                                    <!-- Add more fields as needed -->
                                </div>
                            </div>
                        </div>

                        <div class="book-description">
                            <?php the_content(); ?>
                        </div>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->

            <?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->
        
</main>
<?php
get_footer();   
?>