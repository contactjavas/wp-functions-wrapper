<?php
/**
 * File helper statical interface
 *
 * @package WPFW
 */

namespace Wpfw;

use Wpfw\Helpers\File_Helper;

/**
 * Class to manage statical interface of file helper
 */
class File_Util {

	/**
	 * Copy file to specific destination
	 *
	 * @param string  $source The source path.
	 * @param string  $dest The destination path.
	 * @param integer $permissions The file permission.
	 * @return bool
	 */
	public static function copy( $source, $dest, $permissions = 0755 ) {
		$object = new File_Helper();
		return $object->copy( $source, $dest, $permissions );
	}

	/**
	 * Remove the whole directory
	 *
	 * @param string $dir The directory path.
	 * @return bool
	 */
	public static function remove_dir( $dir ) {
		$object = new File_Helper();
		return $object->remove_dir( $dir );
	}

	/**
	 * Empty a directory
	 *
	 * @param string $dir The directory path.
	 * @return void
	 */
	public static function empty_dir( $dir ) {
		$object = new File_Helper();
		$object->empty_dir( $dir );
	}

	/**
	 * Load components
	 *
	 * @param string  $dir The directory path.
	 * @param integer $max_depth Maximum depth to load the components.
	 * @return void
	 */
	public static function load_components( $dir, $max_depth = 1 ) {
		$object = new File_Helper();
		$object->load_components( $dir, $max_depth );
	}

	/**
	 * Include all files in specific directory
	 *
	 * @param string  $dir The directory path.
	 * @param integer $max_depth Maximum depth to include.
	 * @return void
	 */
	public static function include_all( $dir, $max_depth = 1 ) {
		$object = new File_Helper();
		$object->include_all( $dir, $max_depth );
	}

	/**
	 * Require all files in specific directory
	 *
	 * @param string  $dir The directory path.
	 * @param integer $max_depth Maximum depth to require.
	 * @return void
	 */
	public static function require_all( $dir, $max_depth = 1 ) {
		$object = new File_Helper();
		$object->require_all( $dir, $max_depth );
	}
}
