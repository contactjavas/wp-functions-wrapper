<?php
/**
 * File operation helper.
 *
 * @package WPFW
 */

namespace Wpfw\Helpers;

/**
 * Class to provide file helper methods.
 *
 * @todo Many operations are phpcs-ignored, need to find proper solution.
 */
class File_Helper {

	/**
	 * Maximum scan depth.
	 *
	 * @var integer
	 */
	protected $max_scan_depth = 5;

	/**
	 * Copy a file, or recursively copy a folder and its contents.
	 *
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     1.0.1
	 * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
	 *
	 * @param       string $source    Source path.
	 * @param       string $dest      Destination path.
	 * @param       int    $permissions New folder creation permissions.
	 *
	 * @return      bool     Returns true on success, false on failure.
	 */
	public function copy( $source, $dest, $permissions = 0755 ) {
		// check for symlinks.
		if ( is_link( $source ) ) {
			return symlink( readlink( $source ), $dest ); // phpcs:ignore
		}

		// simple copy for a file.
		if ( is_file( $source ) ) {
			return copy( $source, $dest );
		}

		// make destination directory.
		if ( ! is_dir( $dest ) ) {
			mkdir( $dest, $permissions ); // phpcs:ignore
		}

		// loop through the folder.
		$dir   = dir( $source );
		$entry = $dir->read();

		while ( false !== $entry ) {
			// skip pointers.
			if ( '.' === $entry || '..' === $entry ) {
				continue;
			}

			// deep copy directories.
			$this->copy( "$source/$entry", "$dest/$entry", $permissions );
		}

		// clean up.
		$dir->close();
		return true;
	}

	/**
	 * Thanks for PHP Community
	 * - http://php.net/manual/en/function.rmdir.php#110489
	 * - http://php.net/manual/de/function.rmdir.php#98622
	 *
	 * @param   string $dir    directory to be removed.
	 *
	 * @return  bool
	 */
	public function remove_dir( $dir ) {
		$files = array_diff( scandir( $dir ), array( '.', '..' ) );

		foreach ( $files as $file ) {
			( is_dir( "$dir/$file" ) ) ? rmdir( "$dir/$file" ) : unlink( "$dir/$file" ); // phpcs:ignore
		}

		return rmdir( $dir ); // phpcs:ignore
	}

	/**
	 * Empty a directory.
	 *
	 * @param string $dir The directory path.
	 * @return void
	 */
	public function empty_dir( $dir ) {
		$files = array_diff( scandir( $dir ), array( '.', '..' ) );

		foreach ( $files as $file ) {
			( is_dir( "$dir/$file" ) ) ? rmdir( "$dir/$file" ) : unlink( "$dir/$file" ); // phpcs:ignore
		}
	}

	/**
	 * Based on scripts by Paul Wenzel (https://github.com/pwenzel)
	 * on: Recursively include all PHP files (https://gist.github.com/pwenzel/3438784)
	 *
	 * @param       string $type      include/ require/ module .
	 * @param       string $dir       directory to scan.
	 * @param       int    $depth     the depth level.
	 * @return void
	 */
	protected function scan_dir( $type, $dir, $depth ) {
		if ( $depth > $this->max_scan_depth ) {
			return;
		}

		$scan = glob( $dir . '/*' );

		foreach ( $scan as $path ) {
			if ( 'module' === $type ) {
				if ( is_dir( $path ) ) {
					$this->scan_dir( 'module', $path, $depth + 1 );
				} else {
					$pos = strpos( $path, 'autoload.php' );
					if ( false !== $pos ) {
						require_once $path;
					}
				}
			} else {
				if ( preg_match( '/\.php$/', $path ) ) {
					if ( 'include' === $type ) {
						include_once $path;
					} elseif ( 'require' === $type ) {
						require_once $path;
					}
				} elseif ( is_dir( $path ) ) {
					if ( 'include' === $type ) {
						$this->scan_dir( 'include', $path, $depth + 1 );
					} elseif ( 'require' === $type ) {
						$this->scan_dir( 'require', $path, $depth + 1 );
					}
				}
			}
		}
	}

	/**
	 * Load components.
	 *
	 * @param string  $dir The directory path.
	 * @param integer $max_depth Maximum depth to scan.
	 * @return void
	 */
	public function load_components( $dir, $max_depth = 1 ) {
		if ( $max_depth < 1 ) {
			$max_depth = 1;
		}

		$this->max_scan_depth = $max_depth;
		$this->scan_dir( 'module', $dir, 1 );
	}

	/**
	 * Include all files.
	 *
	 * @param string  $dir The directory path.
	 * @param integer $max_depth Maximum depth to scan.
	 * @return void
	 */
	public function include_all( $dir, $max_depth = 1 ) {
		if ( $max_depth < 1 ) {
			$max_depth = 1;
		}

		$this->max_scan_depth = $max_depth;
		$this->scan_dir( 'include', $dir, 1 );
	}

	/**
	 * Require all files.
	 *
	 * @param string  $dir The directory path.
	 * @param integer $max_depth Maximum depth to scan.
	 * @return void
	 */
	public function require_all( $dir, $max_depth = 1 ) {
		if ( $max_depth < 1 ) {
			$max_depth = 1;
		}

		$this->max_scan_depth = $max_depth;
		$this->scan_dir( 'require', $dir, 1 );
	}
}
