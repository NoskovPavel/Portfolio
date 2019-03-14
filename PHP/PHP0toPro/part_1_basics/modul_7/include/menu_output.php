<div class="<?= $cssClass ?>">
    <ul class="<?= $cssClass ?>__items">
      <?php foreach ($menuItem as $value) : ?>
        <li class="<?= $cssClass ?>__item">
            <a href="<?= $value['path'] ?>" 
               style="<?= ($value['path'] == $urlSection) 
                                  ? 'text-decoration: underline' 
                                  : 'text-decoration: none'?>">
            <?= titleSub\titleSub($value['title']); ?>
            </a>                           
        </li>   
      <?php endforeach; ?>
    </ul>     
</div>
<?php
