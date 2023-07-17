<?php get_header(); ?>
<div class="hero">
  <h1><?php the_title(); ?></h1>
</div>

<main>
  <?php 
    if( have_posts() ){

      while( have_posts() ){

        the_post();
        the_content();

      }
    }
  ?>
<?php
// Custom query to retrieve service posts
$services_query = new WP_Query(array(
    'post_type' => 'service',
    'posts_per_page' => 3,
));

// Check if there are any service posts
if ($services_query->have_posts()) { ?>
  <div class="services-row container" data-type="wide">
    <?php
    while ($services_query->have_posts()) {
      $services_query->the_post();
      $service_image = get_field('service_image');
      $service_short_explanation = get_field('service_short_explanation');
      $service_detailed_explanation = get_field('service_detailed_explanation');
      ?>
      <div class="service-card ">
          <?php if ($service_image) : ?>
              <img class="service-card__image " src="<?php echo esc_url($service_image['url']); ?>" alt="<?php echo esc_attr($service_image['alt']); ?>">
          <?php endif; ?>
          <p class="service-card__blurb"><?php echo esc_html($service_short_explanation); ?></p>
      </div>
    <?php } ?>
  </div>
<?php
// Restore the global post data
wp_reset_postdata();
}
?>
</main>


<?php get_footer(); ?>