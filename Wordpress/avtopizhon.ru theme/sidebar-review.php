
<?php  if(is_active_sidebar('sidebar-review')): ?>
    <section class="review">
        <h2 class="section-title">Наши работы</h2>
        <aside id="sidebar_review">			
				<?php dynamic_sidebar('sidebar-review') ?>
		</aside>
		<div class="review__more">
			<a href="<?php
						$category_id = get_cat_ID( 'Отзывы' );
						$category_link = get_category_link( $category_id );								
						echo $category_link;							
					?>">
				Все наши работы...
			</a>
		</div>
	</section>
<?php endif; ?>

