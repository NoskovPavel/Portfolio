
<?php  if(is_active_sidebar('sidebar-news')): ?>
    <section class="news">
        <h2 class="section-title">Новости</h2>
        <aside id="sidebar_news">			
				<?php dynamic_sidebar('sidebar-news') ?>
		</aside>
	</section>
<?php endif; ?>

