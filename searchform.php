<?php
/**
 * The template for displaying search forms.
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.0
 *
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>" role="search">
	<label for="s" class="label"><?php _e( 'Search', 'birds' ); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'birds' ); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'birds' ); ?>" />
</form>
