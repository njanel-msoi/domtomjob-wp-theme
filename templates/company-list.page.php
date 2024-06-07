<?php

/**
 * Template Name: DTJ Company list
 */
get_header();
?>

<?php
$region = isset($_GET['region']) ? $_GET['region'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
?>
<section class="section-box">
    <div class="banner-hero banner-single banner-single-bg">
        <div class="block-banner text-center">
            <h3 class="">
                Parcourez <span class="color-brand-2">les entreprises</span>
            </h3>
            <div class="font-sm color-text-paragraph-2 mt-10 ">
                Découvrez les entreprises qui recrutent autour de vous
            </div>
            <div class="form-find text-start mt-40 ">

                <form action="" method="get" class="bar-search-form">
                    <select class="form-input mr-10 select-active" name="category">
                        <option value="">Domaine</option>
                        <?php foreach (dtj_get_categories() as $r) : ?>
                            <option value="<?= $r['key'] ?>" <?= $r['key'] == $category ? 'selected="selected"' : '' ?>>
                                <?= $r['description'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select class="form-input mr-10 select-active" name="region">
                        <option value="">Région</option>
                        <?php foreach (dtj_get_regions() as $r) : ?>
                            <option value="<?= $r['key'] ?>" <?= $r['key'] == $region ? 'selected="selected"' : '' ?>>
                                <?= $r['description'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                    <input class="form-input input-keysearch mr-10" type="text" name="query" value="<?= esc_attr($query) ?>" placeholder=" Mot clé...">

                    <button class="btn btn-default btn-find font-sm">Rechercher</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
$shortCodeParams = [];
if ($query) $shortCodeParams[] = 'query="' . $query . '"';
if ($region) $shortCodeParams[] = 'meta__region="' . $region . '"';
if ($category) $shortCodeParams[] = 'meta__category="' . $category . '"';
$shortcode = '[wpjb_employers_list filter="public" ' . implode(' ', $shortCodeParams) . ']';
echo do_shortcode($shortcode);
?>

<?php get_footer(); ?>