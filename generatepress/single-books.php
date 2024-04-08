<?php
get_header(); 
?>
<main>
    <?php while(have_posts()) {
        the_post(); ?>
        <div class="single_post">
            <h2 class="detailed_header"><?php the_title(); ?></h2>

            <p><em><?php the_field('spell_level') ?>-level <?php the_field('school') ?></em> <br>
                <b>Casting Time: </b> <?php the_field('casting_time') ?><br>
                <b>Range: </b> <?php the_field('range') ?><br>
                <b>Components: </b> <?php the_field('components') ?><br>
                <b>Duration: </b> <?php the_field('duration') ?>
            </p>

            <p><?php echo the_content(); ?></p>
    <?php } ?>
        </div>

</main>
<?php
get_footer();   
?>