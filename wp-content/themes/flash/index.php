<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flash
 */

get_header(); ?>
<style>
  .description {
  display: flex;
  justify-content: center;
  }
  .description p {
  margin-right: 20px;
  display: block}

  .text-center {
  text-align: center;
  }

  .margin-center {
  margin-left: auto;
  margin-right: auto;
  }
</style>
<?php
 $img_path = get_template_directory_uri();
 ?>
<p>Добро пожаловать на главную страницу</p>

<img style="width: 100%;" src="<?php echo $img_path ?>/img/main.jpg" />

<p>Вы можете рассмотреть место для себя и своих близких!</p>


<div class="description">
  <p>Низкие цены</p>
  <p>Высокое качество</p>
  <p>Понимающие работники</p>
</div>

<p class="text-center">Наш адрес</p>
<div class="description">
  <img class="" style="width: 60%;dispay: block;margin-bottom: 10px;" src="<?php echo $img_path; ?>/img/map.jpg" alt="Карта" />
</div>

<div class="">
  <p class="text-center">Наши номера</p>
  <?php
   $my_posts = get_posts( array(
	'numberposts' => 5,
  'category_name' => "Номера",
	'orderby'     => 'date',
	'order'       => 'DESC',
	'include'     => array(),
	'exclude'     => array(),
	'meta_key'    => '',
	'meta_value'  =>'',
	'post_type'   => 'post',
  'suppress_filters' => true,
  ) );
//  var_dump($my_posts)
  ?>
  <style>
    .container {
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .container .wrapper {
    background-color: white;
    border: 1px solid black;
    border-radius: 10px;
    -webkit-box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2);
-moz-box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2);
    box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.2);
    padding: 20px;
    margin-bottom: 20px;
    }
    </style>
  <?php if ($my_posts): ?>
  <div class="container">
    <?php
     $count = 0;
     foreach ($my_posts as $post):
     if ($count >= 3) break;
     ?>
    
<div class="wrapper">
  <p><?=$post->post_title?></p>
  <a href="<?php echo $post->guid ?>">Подробнее</a>
</div>
<?php $count += 1; ?>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

<?php
get_sidebar();
get_sidebar('left');
get_footer();
