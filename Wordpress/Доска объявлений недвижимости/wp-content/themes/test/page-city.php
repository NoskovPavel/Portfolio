<?php
	/*
	Template Name: Городa
	*/
?>

<?php
get_header(); 

//Получаем все записи Город и выводим
$city = new WP_Query(array('post_type' => 'city', 'posts_per_page' => -1));  
?>
<main class="clearfix"> 
	<div class="postsFlow clearfix"> 	   
	    <?php
	    if ( $city -> have_posts() ) : 
	    	while ( $city -> have_posts() ) : $city -> the_post();
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
	    		<?php the_content(); ?>
	    	</div>	    	
	    </article>     
	    	<?php endwhile; ?>
	    <?php endif; ?> 
	</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>