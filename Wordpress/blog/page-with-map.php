<?php 
	/*
		Template Name: Контент на фоне карты
		
	*/
?>

<?php get_header(); ?>

<div id="templatemo_main_wrapper">
    <div id="templatemo_content_wrapper">

        <div id="templatemo_content_page">
            <?php if(have_posts()):
                while(have_posts()): the_post(); ?>
                    <?php get_template_part('single-templates/content', get_post_format()) ?>
                <?php endwhile; ?>
            <?php else: ?>
                Записей нет!
            <?php endif; ?>
        </div>
		
               

        <div class="cleaner"></div>
    </div> <!-- end of content wrapper -->

</div>


<?php get_footer(); ?>

