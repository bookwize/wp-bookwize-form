<?php

class Bookwize_Form_Cache {

	public static $prefix = 'bwf_';
	public static $enabled = true;
	public static $configs = [
		'default' => 1000,
		'short'   => 100,
		'long'    => 3000,
		'sitemap' => 6000,
	];

	public static function enable( $mode = true ) {
		self::$enabled = $mode;
	}

	public static function write( $transient, $value, $expiration = null ) {
		if ( self::$enabled === false ) {
			return true;
		}
		if ( $expiration === null ) {
			$expiration = self::$configs['default'];
		}
		set_transient( $transient, $value, $expiration );
	}

	public static function read( $transient = null ) {
		if ( self::$enabled === false ) {
			return false;
		}

		return get_transient( $transient );
	}

	public static function clear( $transient_key = null ) {
		if ( $transient_key == null || strtolower( $transient_key ) == 'all' || $transient_key === 1 ) {
			global $wpdb;

			$transient_key = self::$prefix;
			$transients    = $wpdb->get_col( 'SELECT `option_id` FROM ' . $wpdb->options . ' WHERE `option_name` LIKE "_transient_' . $transient_key . '%" ' );

			foreach ( $transients as $id ) {
				$wpdb->delete( $wpdb->options, array( 'option_id' => $id ) );
			}
		} else {
			delete_transient( $transient_key );
		}

		return true;
	}

	public static function create_key( $key = null ) {
		return self::$prefix . md5( json_encode( $key ) );
	}
}