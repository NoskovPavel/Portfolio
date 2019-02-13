<?php
	/*
	Template Name: Недвижимость
	*/
?>

<?php
//Вывод хедера
get_header(); 

//Получаем все записи Недвижимость и выводим 
$realty = new WP_Query(array('post_type' => 'realty', 'posts_per_page' => -1));  
?>
<main class="clearfix"> 
	<div class="postsFlow clearfix">     
	    <?php
	    if ( $realty -> have_posts() ) : 
	    	while ( $realty -> have_posts() ) : $realty -> the_post();
	    ?> 
	    <article class="postItem">
	    	<h2 class="postItem__title">
	    		<a href="<?php the_permalink() ?>">
	    			<?php the_title() ?>
	    		</a>	
	    	</h2>
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail('thumbnail') ?>
			</a>			
			<div class="postItem__excerpt">
				<a href="<?php the_permalink() ?>">
	    			<?= mb_strimwidth(get_the_content(), 0, 150, '...') ?>	
	    		</a>    		
	    	</div>
	    	<ul class="postItem__description">
		    		<li><?php echo get_field('price').' руб.'; ?></li>
		    		<li><?php echo get_field('area').' м2.'; ?></li>
		    		<li><?php echo get_field('living_area').' м2.'; ?></li>
		    		<li><?php echo get_field('address'); ?></li>
		    		<li><?php echo get_field('level'); ?></li>
		    </ul>
	    </article>     
	    	<?php endwhile; ?>
	    <?php endif; ?> 
	</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>