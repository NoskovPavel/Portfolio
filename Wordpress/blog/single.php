<?php get_header(); ?>


<div id="templatemo_main_wrapper">
    <div id="templatemo_content_wrapper">

        <div id="templatemo_content">
            <?php if(have_posts()):
                while(have_posts()): the_post(); ?>
                    <?php get_template_part('single-templates/content', get_post_format()) ?>
                <?php endwhile; ?>
            <?php else: ?>
                Записей нет!
            <?php endif; ?>



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

