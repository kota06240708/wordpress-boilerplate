<?php
/*
Template Name: all
*/
?>
<?php get_header(); ?>

<main>

<?php
  $args = array(
    'posts_per_page' => 1, // 表示件数
    'orderby' => 'post_date', // 並び順を日付順
    'order' => 'DESC', // 並び順を降順
    'post_type' => 'news', // 投稿の一覧を表示
    'post_status' => 'publish' // 公開済みのものを表示
  );
  $the_query = new WP_Query($args);
  if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<ul>
  <li class="yokonarabi">
    <div class="zenkiji_img">
      <a href="<?php echo get_permalink(); ?>">
        <?php the_post_thumbnail(); ?>
        <?php the_title(); ?>
      </a>
    </div>
  </li>
</ul>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
