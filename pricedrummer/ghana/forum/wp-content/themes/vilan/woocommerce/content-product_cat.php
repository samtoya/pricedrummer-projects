<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$gg_wc_loop_col = apply_filters( 'loop_shop_columns', 4 );
} else {
	$gg_wc_loop_col = $woocommerce_loop['columns'];
}

// Extra post classes
$classes = array();
$classes[] = 'col-xs-12 col-sm-6 col-md-' . floor( 12 / $gg_wc_loop_col );

?>
<li <?php wc_product_cat_class($classes); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<figure class="effect-sadie">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<figcaption>
			<a class="link-wrapper" href="<?php echo esc_url(get_term_link( $category->slug, 'product_cat' )); ?>"></a>
			<span class="woo-category-hover-icn"><i class="icon_cart"></i></span>
		</figcaption>

	</figure>

	<div class="gg-category-meta">
		<h4><?php echo esc_html($category->name); ?></h4>
		<?php
			if ( $category->count > 0 )
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . ' products</mark>', $category );
		?>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>
	</div>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>