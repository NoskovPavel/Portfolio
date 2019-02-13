<?php 
	/*
		Template Name: Лендинг
		
	*/
?>

<?php get_header(); ?>

<div id="templatemo_main_wrapper">
    <div id="templatemo_content_wrapper">
        <div id="templatemo_content_page">
            <?php the_post() ?>
                  <article> 
						<h2> <?php the_title(); ?> </h2>
						<div id="templatemo_menu">
							<?php
								wp_nav_menu([
									'theme_location' => 'landing',
									'container' => 'null',
									'items-wrap' => '<ul>%3$s</ul>',
								])
							?>

						</div>	
						<?php $posts = test_show_reviews() ?>
						<h2> Отзывы </h2>
						<?php foreach($posts as $post): ?>
							<div class="reviewItem">
								<div class="reviewItem_title">
									<?php echo $post -> post_title ?>				
								</div>
								<div class="reviewItem_thumbnail">
									<?php  the_post_thumbnail('thumbnail');	?>				
								</div>
								<div class="reviewItem_content">
									<?php echo $post -> post_content ?>				
								</div>
							</div>
						<?php endforeach; ?>
						<div> <?php the_content(); ?> </div>
				  </article>              
            
        </div>
		
        <?php get_sidebar('one'); ?>  
		
		<div id="templatemo_sidebar_two">

            <div class="banner_250x200">
                <a href="" target="_parent"><img src="
                    <?php
                        echo get_template_directory_uri();
                     ?>
                      /assets/images/250x200_banner.jpg" alt="templates" /></a>
            </div>

            <div class="banner_125x125">
                <a href="" target="_parent"><img src="<?php
                    echo get_template_directory_uri();
                    ?>
                      /assets/images/templatemo_ads.jpg" alt="web 1" /></a>
                <a href="" target="_parent"><img src="<?php
                    echo get_template_directory_uri();
                    ?>
                      /assets/images/templatemo_ads.jpg" alt="web 2" /></a>
                <a href="" target="_parent"><img src="<?php
                    echo get_template_directory_uri();
                    ?>
                      /assets/images/templatemo_ads.jpg" alt="templates 2" /></a>
                <a href="" target="_parent"><img src="<?php
                    echo get_template_directory_uri();
                    ?>
                      /assets/images/templatemo_ads.jpg" alt="templates 1" /></a>
            </div>

            <div class="cleaner_h40"></div>
            <div class="sidebar_two_box">

                <h4>Useful Resources</h4>
                <ul class="templatemo_list">
                    <li><a href="" target="_parent">Free CSS Templates</a></li>
                    <li><a href="" target="_parent">Flash Templates</a></li>
                    <li><a href="" target="_parent">Website Templates</a></li>
                    <li><a href="" target="_parent">Web Design Blog</a></li>
                    <li><a href="" target="_parent">Flash Web Gallery</a></li>
                    <li><a href="#">Curabitur sed lacinia</a></li>
                    <li><a href="#">Vestibulum laoreet tincidunt</a></li>
                    <li><a href="#">Nullam nec mi enim</a></li>
                    <li><a href="#">Aliquam quam nulla</a></li>
                    <li><a href="#">Curabitur non felis massa</a></li>
                </ul>
            </div>
        </div>		

        <div class="cleaner"></div>
    </div> <!-- end of content wrapper -->

</div>


<?php get_footer(); ?>

