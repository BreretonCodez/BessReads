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
                                    <h3><a class="text-black" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></h3>
                                    <br>
                                    <p> <?php echo get_the_excerpt();  ?> </p>
                                    <p><strong class="text-black">Genres: </strong><?php echo get_the_category_list(', '); ?></p>
                                    <?php 
                                        $book_man_id = get_post_meta(get_the_ID(), 'book_manuscript', true);
                                        $book_url = wp_get_attachment_url($book_man_id);

                                    if(is_user_logged_in()) {
                                    ?>
                                    <div class="btn btn-primary">
                                        <a class="text-white" href="<?php echo esc_url($book_url); ?>">Download Sample</a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="book-description">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <br class="mt-4">
                    <footer class="entry-footer">
                        <h2>Q&A Corner</h2>
                        <?php
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </footer>
                </article>

            <?php endwhile; ?>

        </main>
    </div>
        
</main>
<?php
get_footer();   
?>