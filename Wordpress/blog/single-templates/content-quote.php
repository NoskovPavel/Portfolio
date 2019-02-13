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

                        <div id="comment_section">
                            <ol class="comments first_level">
                                    <?php
                                    $comments = get_comments(array(
                                        'post_id' => get_the_ID(),
                                        'status' => 'approve'
                                    ));
                                    wp_list_comments(array(
                                        'per_page' => 10,
                                        'reverse_top_level' => false,
                                        'avatar_size'       => 50
                                    ), $comments);
                                    ?>                                
                            </ol>
                        </div>                       
						<?php comments_template(); ?>
					</div>
       