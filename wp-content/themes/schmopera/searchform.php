<?php
/**
 * The template for displaying search forms in schmopera
 *
 * @package schmopera
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="param_search">
		<?php _ex( 'Search for:', 'label', 'sch' ); ?>
	</label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'sch' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="param_search">

	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sch' ); ?>">
</form>