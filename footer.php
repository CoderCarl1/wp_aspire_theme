<?php
// Retrieve all social posts
$socials = new WP_Query(array(
    'post_type' => 'social',
    'posts_per_page' => -1, 
));
?>

<?php 
    wp_footer(); 
  ?>
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-logo">

      </div>
      <div class="footer-socials">
        <?php if ($socials->have_posts()) : ?>
        <ul class="navbar-social">
            <?php while ($socials->have_posts()) : $socials->the_post(); ?>
                <?php
                $social_image = get_field('social_image');
                $social_url = get_field('social_url');
                $social_text = get_field('social_text');
                ?>

                <li>
                    <a href="<?php echo esc_url($social_url); ?>">
                      <img src="<?php echo esc_url($social_image['url']);  ?>" alt="<?php echo $social_text; ?>">
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php wp_reset_postdata(); ?>
    <?php endif; ?>
      </div>
    </div>
    <p class="footer-copyright center"> &copy; Aspire2Life 2023. ABN 95 636 793 934</p>
  </footer>
</body>
</html>