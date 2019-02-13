<?php get_header(); ?>


<div id="templatemo_main_wrapper">
    <div id="templatemo_content_wrapper">

        <div id="templatemo_content_page">
            <?php the_post();  ?>
                <h2><?php the_title(); ?></h2>
				<div><?php the_post_thumbnail('thumbnail'); ?> </div>
                <div><?php the_content();  ?></div>
				
				<div>
					<?php
						$terms = get_the_terms($post -> ID, 'city');
							if( $terms && ! is_wp_error($terms) ){
								echo "<ul>";
								foreach( $terms as $term ){
									echo "<li><a href=".get_term_link($term -> term_id) ."\">". $term->name ."</li>";
								}
								echo "</ul>";
							}
					?>
				</div>
        </div>


        <?php get_sidebar('one'); ?>


        <div id="templatemo_sidebar_two">

            <aside>
				<h2>Оставить заявку</h2>
				<form>
					<input type="hidden" name="id_flat" value="<?php echo $post -> ID ?>">
					<div>
						<div>Телефон</div>
						<br>
						<div>
							<input type="text" name="phone">
						</div>
					</div>
					<br>
					<input class="flat-app-btn" type="button" value="Отправить">
				</form>		
			</aside>

            

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

