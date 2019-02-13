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
		</article>
		<article class="child-realty">
			<h2>Объекты недвижимости в этом городе</h2>
			<div class="child-realty__items">
		<?php 		
		$realty = get_posts(array( 'post_type'=>'realty', 'post_parent'=>$post->ID, 'posts_per_page'=>10, 'orderby'=>'date', 'order'=>'ASC' ));	
		if( $realty ) {			
			foreach( $realty as $player ){				
		?>					
				<div class="child-realty__item">
					<div class="child-realty__title">
						<a href="<?= $player -> guid ?>">
							<?= $player -> post_title ?>
						</a>						
					</div>
					<div class="child-realty__thumbnails">
						<a href="<?= $player -> guid ?>">
							<?= get_the_post_thumbnail( $player -> ID, 'thumbnail'); ?>
						</a>
					</div>
					<div class="child-realty__excerpt">
						<a href="<?= $player -> guid ?>">
						<?= mb_strimwidth($player -> post_content, 0, 50, '...');?>
						</a>
					</div>
				</div>
		
		<?php
			}
		} else 	echo 'Нет объектов недвижимости в этом городе.';
		?>	
		</div>	
		</article>
	</div>
</main>
<?php get_footer(); ?>