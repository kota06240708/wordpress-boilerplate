<?php
/*
Template Name: フロント
*/
?>

<?php get_header(); ?>

<div class="front-wrap">
  <div class="front-inner">
    <ul class="front-list">
      <li class="front-lists">
        <a class="front-lists-link" href="<?php echo get_permalink( get_page_by_path( 'contact' )->ID ); ?>">
          フロントページ
        </a>
      </li>
      <li class="front-lists">
        <a class="front-lists-link" href="<?php echo get_post_type_archive_link( 'news' ); ?>">
          アーカイブページ
        </a>
      </li>
    </ul>
    <p>ウイジェット設定</p>
    <?php dynamic_sidebar('sidebar-1'); ?>
    <div class="contents">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
          ?>
          <?php get_template_part( 'article' ); ?>

          <?php endwhile; ?><!--ループ終了-->
          <?php else : ?>
          <p>投稿ないよ</p>
          <?php endif; ?>
    </div>
    <p>アーカイブ</p>
    <?php
    $year_prev = null;
    $months = $wpdb->get_results(
      "SELECT DISTINCT MONTH( post_date ) AS month ,
      YEAR( post_date ) AS year,
      COUNT( id ) as post_count FROM $wpdb->posts
      WHERE post_status = 'publish' and post_date <= now( )
      and post_type = 'post'
      GROUP BY month , year
      ORDER BY post_date DESC"
    );

    foreach($months as $month) :
    $year_current = $month->year;
    if ($year_current != $year_prev){
    if ($year_prev != null){?>
                </ul></div>
            <?php } ?>
    <div><h4><?php echo $month->year; ?>年</h4>
    <ul>
    <?php } ?>
    <li>
        <a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>">
            <?php echo date("n", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>月
            (<?php echo $month->post_count; ?>)
        </a>
    </li>
    <?php $year_prev = $year_current;
    endforeach; ?>
</ul></div>
  </div>
</div>

<?php get_footer(); ?>
