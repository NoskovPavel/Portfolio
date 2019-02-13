<?php get_header(); ?>
<main class="clearfix">
	<div class="postsFlow clearfix">
		<?php the_post(); ?>
		<article class="postItem-full">
			<h1 class="section__title"><?php the_title() ?></h1>			
			<div class="thumb">
				<?php the_post_thumbnail('large') ?>
			</div>
			<h2><?php the_title() ?></h2>
			<div><?php the_content() ?></div>						
			<ul class="postItem__description">
	    		<li>Стоимость: <?php echo get_field('price').' руб.'; ?></li>
	    		<li>Общая площадь: <?php echo get_field('area').' м2.'; ?></li>
	    		<li>Жилая площадь: <?php echo get_field('living_area').' м2.'; ?></li>
	    		<li>Адрес: <?php echo get_field('address'); ?></li>
	    		<li>Этаж (либо этажность): <?php echo get_field('level'); ?></li>
		    </ul>
		</article>
	</div>
</main>
<?php get_footer(); ?>