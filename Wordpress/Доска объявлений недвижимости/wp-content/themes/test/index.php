<?php
/**
 * The front page template file
 * 
 * @package WordPress
 * @subpackage test
 * 
 */
get_header(); ?>
<main class="main">
	<section class="realty">
		<h1 class="section__title">
			База недвижимости
		</h1>		
		<?php	//Получаем последних 6 записей Недвижимость и выводим их 
		$realty = new WP_Query(array('post_type' => 'realty', 'posts_per_page' => 6));  
		?>
		<div class="postsFlow clearfix">     
		    <?php
		    if ( $realty -> have_posts() ) : 
		    	while ( $realty -> have_posts() ) : $realty -> the_post();
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
					<a href="<?php the_permalink() ?>">
		    			<?= mb_strimwidth(get_the_content(), 0, 150, '...') ?>
		    		</a>
		    	</div>		    	
		    	<ul class="postItem__description">
		    		<li>Стоимость: <?php echo get_field('price').' руб.'; ?></li>
		    		<li>Общая площадь: <?php echo get_field('area').' м2.'; ?></li>
		    		<li>Жилая площадь: <?php echo get_field('living_area').' м2.'; ?></li>
		    		<li>Адрес: <?php echo get_field('address'); ?></li>
		    		<li>Этаж (либо этажность): <?php echo get_field('level'); ?></li>
			    </ul>
		    </article> 		       
		    	<?php endwhile; ?>
		    <?php endif; ?>			    	    
		</div>
	</section>
	<section class="city">
		<h1 class="section__title">
			Города
		</h1>
		<?php	//Получаем последние 6 записей Города и выводим их 
		$city = new WP_Query(array('post_type' => 'city', 'posts_per_page' => 6));  
		?>
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
		    		<?php the_excerpt(); ?>
		    	</div>		    	
		    </article> 		       
		    	<?php endwhile; ?>
		    <?php endif; ?>		    
		</div>
	</section>	
	<section class="form">
		<h2 class="section__title">
			Разместите свой объект недвижимости
		</h2>
	<?php	
	// получим все термины таксономии property_type для выбора в форме	
	$tags_array = get_terms('property_type', 'orderby=none&hide_empty=0&parent=0'); 
	foreach ($tags_array as $tag) { // пробежим по каждому
	  $tags .= '<label><input type="radio" name="tag" value="'.$tag->term_id.'">'.$tag->name.'</label>'; // суем все в radio баттоны
	}

	//Получим все записи типа Город и выведем в форму для выбора
	$city = new WP_Query(array('post_type' => 'city', 'posts_per_page' => -1));
	    if ( $city -> have_posts() ) { 
		   	while ( $city -> have_posts() ) {
				$city -> the_post();
				$citys .= '<label><input type="radio" name="city" value="'.get_the_ID().'">'.get_the_title().'</label>'; 
		   	} 
		}	
	 // Выводим форму ?>
	<form method="post" enctype="multipart/form-data" id="add_object">		

		<label for="title">Введите название объекта недвижимости</label>
		<input id="title" type="text" name="post_title" required/>
		
		<label>Выберите тип недвижимости</label>
	  	<?=$tags; // выводим термины таксономии  в radio ?>
			
		<label>Выберите город расположения</label>
	  	<?=$citys; // выводим города в radio ?>
				
		<label for="content">Введите описание недвижимости</label>
		<textarea id="content" name="post_content" required/>Описание</textarea>
		
		<label for="area">Введите общую площадь недвижимости</label>
		<input id="area" type="text" name="area"/>

		<label for="price">Введите стоимость недвижимости</label>
		<input id="price" type="text" name="price"/></input>

		<label for="address">Введите адрес</label>
		<input id="address" type="text" name="address"/></input>

		<label for="living_area">Введите жилую площадь</label>
		<input id="living_area" type="text" name="living_area"/></input>

		<label for="level">Введите этаж (либо этажность для индивидуального дома</label>
		<input id="level" type="text" name="level"/></input>

		<label for="thumbnail">Изображение объекта недвижимости: </label>
		<input id="thumbnail" type="file" name="img"/>

		<label for="addit-thumbnail" id="first_img" class='imgs'>Дополнительные фото:</label>
		<input id="addit-thumbnail" type='file' name='imgs[]'/>

		<a href="#" id="add_img">Загрузить еще фото</a></br>
		<input type="submit" name="button" value="Отправить" id="sub"/>
		<div id="output"></div> <?php // сюда будем выводить ответ ?>
	</form>
	</section>
</main>
<?php get_footer(); ?>