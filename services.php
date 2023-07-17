<?php /* Template Name: Services */ ?>

<?php get_header(); ?>
<div class="hero">
  <h1><?php the_title(); ?></h1>
</div>

<main>
  <?php 
    if( !empty( get_the_content() ) ){
        the_content();
    }

  // Custom query to retrieve service posts
  $services_query = new WP_Query(array(
      'post_type' => 'service'
  ));

  if ($services_query->have_posts()) { ?>
    <div class="services-row container" data-type="wide">
      
      <?php
      while ($services_query->have_posts()) {
        $services_query->the_post();
        $service_image = get_field('service_image');
        $service_detailed_explanation = get_field('service_detailed_explanation');
        ?>
        <div class="service-card service-card__fullsize flex-wrap">
          <?php if ($service_image) : ?>
              <img class="service-card__image " src="<?php echo esc_url($service_image['url']); ?>" alt="<?php echo esc_attr($service_image['alt']); ?>">
          <?php endif; ?>
          <div class="service-card__blurb">
            <?php echo $service_detailed_explanation; ?>
          </div>
        </div>
      <?php } ?>

    </div>
<?php
  wp_reset_postdata();
  }
?>
</main>


<?php get_footer(); ?>