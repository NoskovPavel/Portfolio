                    <div class="post_section">
                        <span class="bottom"></span>
                        <h2><?php the_title() ?></h2>
                        <strong>Date:</strong> <?php the_date('d F Y'); ?> | <strong>Author:</strong> <?php the_author(); ?>
                        <a href="<?php the_permalink() ?>">
                            <?php the_post_thumbnail('thumbnail') ?>
                        </a>
                        <span><?php the_content() ?></span>
                        <div class="cleaner"></div>
                        <div class="category">
                           Category:  <?php the_category(', '); ?>

                        </div>
                        <div class="cleaner"></div>
                        <div class="comment_tab">
                            <?php comments_number('0', '1', '%'); ?> Comments
                        </div>

                        
					</div>
       