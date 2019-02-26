<?php
/**
 * Minimum_Requirements
 *
 * @package  Birds_Starter_Theme
 * @since    1.0.4
 *
 */

// Usage : $requirements = new Minimum_Requirements( '5.3', '3.5', 'YOUR THEME NAME', array( 'plugin-a', 'plugin-b' ) );
if ( ! class_exists( 'Minimum_Requirements' ) ) {
	class Minimum_Requirements {
		private $php_ver;
		private $wp_ver;
		private $name;
		private $plugins;
		private $not_found = array();

		public function __construct( $php_ver, $wp_ver, $name = '', array $plugins = array() ) {
			if ( ! is_string( $php_ver ) ) {
				throw new InvalidArgumentException( 'PHP version must be a string' );
			}
			if ( ! is_string( $wp_ver ) ) {
				throw new InvalidArgumentException( 'WordPress version must be a string' );
			}
			if ( ! is_string( $name ) ) {
				throw new InvalidArgumentException( 'Plugin name must be a string' );
			}
			$this->php_ver = $php_ver;
			$this->wp_ver = $wp_ver;
			$this->name = $name;
			$this->plugins = $plugins;
		}

		public function is_compatible_php() {
			if ( version_compare( phpversion(), $this->php_ver, '<' ) ) {
				return false;
			}
			return true;
		}

		public function is_compatible_wordpress() {
			if ( version_compare( $GLOBALS['wp_version'], $this->wp_ver, '<' ) ) {
				return false;
			}
			return true;
		}

		public function are_required_plugins_active() {
			if ( empty( $this->plugins ) ) {
				return true;
			}
			$result = true;
			$_active_plugins = wp_get_active_and_valid_plugins();
			$active_plugins  = array_filter( array_map( array( $this, 'get_plugin_name' ), $_active_plugins ) );
			foreach ( $this->plugins as $plugin ) {
				if ( ! in_array( $plugin, $active_plugins, true ) ) {
					$result            = false;
					$this->not_found[] = $plugin;
				}
			}
			return $result;
		}

		public function is_compatible_version() {
			if ( $this->is_compatible_php() && $this->is_compatible_wordpress() && $this->are_required_plugins_active() ) {
				return true;
			}
			return false;
		}

		public function get_admin_notices_php( $wrap ) {
			return $this->get_admin_notices_text( $wrap, 'PHP', phpversion(), $this->php_ver );
		}

		public function get_admin_notices_wordpress( $wrap ) {
			return $this->get_admin_notices_text( $wrap, 'WordPress', $GLOBALS['wp_version'], $this->wp_ver );
		}

		public function get_admin_notices_required_plugins( $wrap ) {
			$html = __( 'requires %s plugins to work', 'birds' );
			if ( false === $wrap ) {
				$html = '<div>' . $html . '</div>';
			} else {
				$html = '<div class="error"><p><b>' . $this->name . '</b> - ' . $html . '</p></div>';
			}
			$plugins = implode( ', ', $this->not_found );
			return sprintf( $html, $plugins );
		}

		public function get_admin_notices_text( $wrap, $s1, $s2, $s3 ) {
			$html = __( 'Your server is running %s version %s but this theme requires at least %s', 'birds' ) . '<br/>' . __( 'Some functions it uses may cause a dysfunction of your website. You should consider upgrading.', 'birds' );
			if ( false === $wrap ) {
				$html = '<div>' . $html . '</div>';
			} else {
				$html = '<div class="error"><p><b>' . $this->name . ' Notice</b> - ' . $html . '</p></div>';
			}
			return sprintf( $html, $s1, $s2, $s3 );
		}

		public function check_compatibility_on_install() {
			if ( ! $this->is_compatible_version() ) {
				$message = __( 'Activation of %s in not possible', 'birds' );
				$html = '<div>' . __( 'Activation of ', 'birds' ) . $this->name . __( ' is not possible', 'birds' ) . ':</div><ul>';
				if ( ! $this->is_compatible_php() ) {
					$html .= '<li>' . $this->get_admin_notices_php( false ) . '</li>';
				}
				if ( ! $this->is_compatible_wordpress() ) {
					$html .= '<li>' . $this->get_admin_notices_wordpress( false ) . '</li>';
				}
				if ( ! $this->are_required_plugins_active() ) {
					$html .= '<li>' . $this->get_admin_notices_required_plugins( false ) . '</li>';
				}
				$html .= '</ul>';
				wp_die( $html, __( 'Activation of ', 'birds' ) . $this->name . __( ' is not possible', 'birds' ), array( 'back_link' => true ) ); // XSS ok.
			};
		}

		public function load_admin_notices() {
			if ( ! $this->is_compatible_php() ) {
				echo $this->get_admin_notices_php( true ); // XSS ok.
			}
			if ( ! $this->is_compatible_wordpress() ) {
				echo $this->get_admin_notices_wordpress( true ); // XSS ok.
			}
			if ( ! $this->are_required_plugins_active() ) {
				echo $this->get_admin_notices_required_plugins( true ); // XSS ok.
			}
		}

		private function get_plugin_name( $plugin ) {
			$plugin_data = get_plugin_data( $plugin );
			if ( ! ( is_array( $plugin_data ) && isset( $plugin_data['Name'] ) ) ) {
				return false;
			}
			return sanitize_title( $plugin_data['Name'] );
		}
	}
}
