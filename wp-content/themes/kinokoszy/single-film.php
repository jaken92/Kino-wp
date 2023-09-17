<?php
$articles = get_field('FilmArticles');
?>
<?php get_header(); ?>
<section class="hero-section">
    <div class="arrow-container">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Group 6.png" alt="">
    </div>
    <div class="title-container">
        <h1>
            FILMS
        </h1>
    </div>
</section>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
        $image = get_field('image_film');
        if (!empty($image)) : ?>
            <img class="single-film-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        <section>
            <div class="single-film-heading">
                <h2><?php the_title() ?></h2>
            </div>
        </section>
        <p class="single-film-paragraph"><?php the_field('film_paragraph') ?>
        <p class="single-film-director">Directors: <br> <?php the_field("directors") ?>
        <div class="articles-grid">
            <?php if (!empty($articles)) :
                foreach ($articles as $featured_post) :
                    $permalink = get_permalink($featured_post->ID);
                    $title = get_the_title($featured_post->ID);
                    $custom_field = get_field('article_paragraph', $featured_post->ID); ?>

                    <div class="articles-post">
                        <h3><?php echo $title ?></h3>
                        <p><?php echo $custom_field ?></p>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php
$args = array(
    "post_type" => "film",
    "orderby" => "date",
    "order" => "DESC",
);
// The Query
$the_query = new WP_Query($args); ?>
<div class="links-wrapper">
    <div class="single-film-links-container">
        <div class="arrows-container">
            <div><img class="left-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/films/leftarrow.png
            " alt=""></div>
            <div><img class="right-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/films/rightarrow.png
            " alt=""></div>
        </div>
        <?php if ($the_query->have_posts()) :

            while ($the_query->have_posts()) :
                $the_query->the_post(); ?>
                <div class="single-film-link-container">
                    <?php $image = get_field('image_film'); ?>

                    <a href="<?php the_permalink() ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </a>
                    <div class="title-links">
                        <p>//</p><a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                    </div>
                    <a href=""></a>
                </div>
            <?php endwhile ?>

        <?php endif ?>
    </div>
</div>
<?php
wp_footer();

get_footer(); ?>