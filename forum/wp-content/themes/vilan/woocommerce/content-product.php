<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

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

<li <?php post_class( $classes ); ?>>

	<div class="thumbnail">

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

		<div class="caption">

			<div class="gg-header-product-meta">
	  			<div class="title-wrapper">
					<h3><?php the_title(); ?></h3>
					<?php echo esc_html(woocommerce_display_product_category($post)); ?>
				</div>
				
				<div class="price-wrapper">	
					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
				</div>
			</div>

			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

		</div>

	</div>

</li>