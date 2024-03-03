<?php
/**
 * Plugin Name: ACF Block Bindings Demo
 * Description: An example demo plugin showing how ACF block bindings may work.
 * Author: Liam Gladdy
 * Version: 0.1-alpha1
 */

/**
 * Register plugin bindings on init.
 *
 * @since 0.1
 */
add_action(
	'init',
	function () {

        /**
         * Only run if ACF is installed an activated.
         */
		if ( ! function_exists( 'acf_get_setting' ) ) {
			return;
		}

		/**
		* Check if a currently fictional `acf/settings/enable_block_bindings` exists.
		* This gives ACF a way to disable this plugin when/if this makes it into ACF core.
		*/
		$upstream_setting = acf_get_setting( 'enable_block_bindings' );
		if ( $upstream_setting === null ) {
			register_acf_block_bindings_source();
		}
	}
);

/**
 * Handle returing the block binding value for an ACF meta value.
 *
 * @since 0.1
 *
 * @param array $source_attrs An array of the source attributes requested.
 * @return string The block binding value
 */
function acfbb_get_block_binding_post_value( $source_attrs ) {

	if ( ! isset( $source_attrs['key'] ) ) {
		return null;
	}

	$field_value = get_field( $source_attrs['key'] );

	return $field_value;
}

/**
 * Registers the "acf/post" source for the Block Bindings API.
 * This allows you to access formatted ACF meta values on the current post.
 *
 * @since 0.1
 */
function register_acf_block_bindings_source() {
	register_block_bindings_source(
		'acf/post',
		array(
			'label'              => _x( 'ACF', 'acf' ),
			'get_value_callback' => 'acfbb_get_block_binding_post_value',
		)
	);
}
