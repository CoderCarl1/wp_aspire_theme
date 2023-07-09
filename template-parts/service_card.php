<?php
/**
 * Template part for displaying a service card.
 */
?>

<div class="service-card">
    <?php if (has_post_thumbnail()) : ?>
        <div class="service-image">
            <?php the_post_thumbnail('medium'); ?>
        </div>
    <?php endif; ?>

    <div class="service-description">
        <?php the_field('short_explanation'); ?>
    </div>
</div>

lorem