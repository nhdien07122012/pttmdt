<?php
defined("ABSPATH") or die("");

/**
 * Various Static Utility methods for working with the installer
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2 Full Documentation
 *
 * @package SC\DUPX\U
 *
 */
class DUPX_U
{
	public static $on_php_53_plus;

	public static function init()
	{
		self::$on_php_53_plus = version_compare(PHP_VERSION, '5.3.2', '>=');
	}

	/**
	 * Adds a slash to the end of a file or directory path
	 *
	 * @param string $path		A path
	 *
	 * @return string The original $path with a with '/' added to the end.
	 */
	public static function addSlash($path)
	{
		$last_char = substr($path, strlen($path) - 1, 1);
		if ($last_char != '/') {
			$path .= '/';
		}
		return $path;
	}

    public static function queueReplacementWithEncodings($search, $replace)
    {
        $search_json = str_replace('"', "", json_encode($search));
        $replace_json = str_replace('"', "", json_encode($replace));
        $search_urlencode = urlencode($search);
        $replace_urlencode = urlencode($replace);

        array_push($GLOBALS['REPLACE_LIST'],
            array('search' => $search,			 'replace' => $replace),
            array('search' => $search_json,		 'replace' => $replace_json),
            array('search' => $search_urlencode, 'replace' => $replace_urlencode));
    }

	/**
	 * Does one string contain other
	 *
	 * @param string $haystack		The full string to search
	 * @param string $needle		The substring to search on
	 *
	 * @return bool Returns true if the $needle was found in the $haystack
	 */
	public static function contains($haystack, $needle)
	{
		$pos = strpos($haystack, $needle);
		return ($pos !== false);
	}

	/**
	 * Recursively copy files from one directory to another
	 *
	 * @param string $src - Source of files being moved
	 * @param string $dest - Destination of files being moved
	 * @param string $recursive recursively remove all items
	 *
	 * @return bool Returns true if all content was copied
	 */
	public static function copyDirectory($src, $dest, $recursive = true)
	{
		//RSR TODO:Verify this logic
		$success = true;

		// If source is not a directory stop processing
		if (!is_dir($src)) {
			return false;
		}

		// If the destination directory does not exist create it
		if (!is_dir($dest)) {
			if (!mkdir($dest)) {
				// If the destination directory could not be created stop processing
				return false;
			}
		}

		// Open the source directory to read in files
		$iterator = new DirectoryIterator($src);

		foreach ($iterator as $file) {
			if ($file->isFile()) {
				$success = copy($file->getRealPath(), "$dest/".$file->getFilename());
			} else if (!$file->isDot() && $file->isDir() && $recursive) {
				$success = self::copyDirectory($file->getRealPath(), "$dest/$file", $recursive);
			}

			if (!$success) {
				break;
			}
		}

		return $success;
	}

     /**
     *  Check to see if the internet is accessible
     *
     *  Note: fsocketopen on windows doesn't seem to honor $timeout setting.
     *
     *  @param string $url		A url e.g without prefix "ajax.googleapis.com"
     *  @param string $port		A valid port number
     *
     *  @return bool	Returns true PHP can request the URL
     */
    public static function isURLActive($url, $port, $timeout = 5)
    {
        if (function_exists('fsockopen')) {
            @ini_set("default_socket_timeout", 5);
            $port      = isset($port) && is_integer($port) ? $port : 80;
            $connected = @fsockopen($url, $port, $errno, $errstr, $timeout); //website and port
            if ($connected) {
                @fclose($connected);
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    
	/**
	 *  A safe method used to copy larger files
	 *
	 * @param string $source		The path to the file being copied
	 * @param string $destination	The path to the file being made
	 *
	 * @return null
	 */
	public static function copyFile($source, $destination)
	{
		$sp	 = fopen($source, 'r');
		$op	 = fopen($destination, 'w');

		while (!feof($sp)) {
			$buffer = fread($sp, 512);  // use a buffer of 512 bytes
			fwrite($op, $buffer);
		}
		// close handles
		fclose($op);
		fclose($sp);
	}

	/**
	 * Safely remove a directory and recursively if needed
	 *
	 * @param string $directory The full path to the directory to remove
	 * @param string $recursive recursively remove all items
	 *
	 * @return bool Returns true if all content was removed
	 */
	public static function deleteDirectory($directory, $recursive)
	{
		$success = true;

		if ($excepted_subdirectories = null) {
			$excepted_subdirectories = array();
		}

		$filenames = array_diff(scandir($directory), array('.', '..'));

		foreach ($filenames as $filename) {
			if (is_dir("$directory/$filename")) {
				if ($recursive) {
					$success = self::deleteDirectory("$directory/$filename", true);
				}
			} else {
				$success = @unlink("$directory/$filename");
			}

			if ($success === false) {
				//self::log("Problem deleting $directory/$filename");
				break;
			}
		}

		return $success && rmdir($directory);
	}

	/**
	 * Dumps a variable for debugging
	 *
	 * @param string $var The variable to view
	 * @param bool	 $pretty Pretty print the var
	 *
	 * @return object A visual representation of an object
	 */
	public static function dump($var, $pretty = false)
	{
		if ($pretty) {
			echo '<pre>';
			print_r($var);
			echo '</pre>';
		} else {
			print_r($var);
		}
	}

    public static function echoBool($val)
    {
        if($val) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

	/**
	 * Return a string with the elapsed time
	 *
	 * @see getMicrotime()
	 *
	 * @param mixed number $end     The final time in the sequence to measure
	 * @param mixed number $start   The start time in the sequence to measure
	 *
	 * @return  string   The time elapsed from $start to $end
	 */
	public static function elapsedTime($end, $start)
	{
		return sprintf("%.4f sec.", abs($end - $start));
	}

	/**
	 * Convert all applicable characters to HTML entities
	 *
	 * @param string $string    String that needs conversion
	 * @param bool $echo        Echo or return as a variable
	 *
	 * @return string    Escaped string.
	 */
	public static function escapeHTML($string = '', $echo = false)
	{
		$output = htmlentities($string, ENT_QUOTES, 'UTF-8');
		if ($echo) echo $output;
		else return $output;
	}

	/**
	 *  Returns 256 spaces
	 *
	 *  PHP_SAPI for fcgi requires a data flush of at least 256
	 *  bytes every 40 seconds or else it forces a script halt
	 *
	 * @return string A series of 256 spaces ' '
	 */
	public static function fcgiFlush()
	{
		echo(str_repeat(' ', 256));
		@flush();
	}

	/**
	 *  Returns the active plugins for the WordPress website in the package
	 *
	 *  @param  obj    $dbh	 A database connection handle
	 *
	 *  @return array  $list A list of active plugins
	 */
	public static function getActivePlugins($dbh)
	{
		// Standard WP installation
		$select = "option_value";
		$table  = "options";
		$where  = "option_name = 'active_plugins'";

		// Multisite setup
		if( $GLOBALS['DUPX_AC']->mu_mode > 0 )
		{
			$select = "meta_value";
			$table  = "sitemeta";
			$where  = "meta_key = 'active_sitewide_plugins'";
		}

		$query = @mysqli_query($dbh, "SELECT {$select} FROM `{$GLOBALS['DUPX_AC']->wp_tableprefix}{$table}` WHERE {$where} ");
		if ($query) {
			$row		 = @mysqli_fetch_array($query);
			$all_plugins = unserialize($row[0]);

			// Multisite array use plugin data like key and timestamp like value. We must flip to can display properly.
			if( $GLOBALS['DUPX_AC']->mu_mode > 0 )
				$all_plugins = array_flip($all_plugins);

			// Return data properly
			if (is_array($all_plugins)) {
				return $all_plugins;
			}
		}
		return array();
	}

	/**
	 * Get current microtime as a float.  Method is used for simple profiling
	 *
	 * @see elapsedTime
	 *
	 * @return  string   A float in the form "msec sec", where sec is the number of seconds since the Unix epoch
	 */
	public static function getMicrotime()
	{
		return microtime(true);
	}

	/**
	 *  Gets the size of a variable in memory
	 *
	 *  @param $var		A valid PHP variable
	 *
	 *  @returns int	The amount of memory the variable has consumed
	 */
	public static function getVarSize($var)
	{
		$start_memory	 = memory_get_usage();
		$var			 = unserialize(serialize($var));
		return memory_get_usage() - $start_memory - PHP_INT_SIZE * 8;
	}

	/**
	 * Is the string JSON
	 *
	 * @param string $string Any string blob
	 *
	 * @return bool Returns true if the string is JSON encoded
	 */
	public static function isJSON($string)
	{

		return is_string($string) && is_array(json_decode($string, true)) ? true : false;
	}

	/**
	 * Does a string have non ASCII characters
	 *
	 * @param string $string Any string blob
	 *
	 * @return bool Returns true if any non ASCII character is found in the blob
	 */
	public static function isNonASCII($string)
	{
		return preg_match('/[^\x20-\x7f]/', $string);
	}

    /**
     * Is the server running Windows operating system
     *
     * @return bool Returns true if operating system is Windows
     *
     */
    public static function isWindows()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        {
            return true;
        }
        return false;
    }

	/**
	 *  The characters that are special in the replacement value of preg_replace are not the
	 *  same characters that are special in the pattern.  Allows for '$' to be safely passed.
	 *
	 *  @param string $str		The string to replace on
	 */
	public static function pregReplacementQuote($str)
	{
		return preg_replace('/(\$|\\\\)(?=\d)/', '\\\\\1', $str);
	}

	/**
	 * Display human readable byte sizes
	 *
	 * @param string $size	The size in bytes
	 *
	 * @return string Human readable bytes such as 50MB, 1GB
	 */
	public static function readableByteSize($size)
	{
		try {
			$units = array('B', 'KB', 'MB', 'GB', 'TB');
			for ($i = 0; $size >= 1024 && $i < 4; $i++)
				$size /= 1024;
			return round($size, 2).$units[$i];
		} catch (Exception $e) {
			return "n/a";
		}
	}

	/**
	 * Converts shorthand memory notation value to bytes
	 * From http://php.net/manual/en/function.ini-get.php
	 *
	 * @param $val Memory size shorthand notation string
	 *
	 * @return int	Returns the numeric byte from 1MB to 1024
	 */
	public static function returnBytes($val)
	{
		$val	 = trim($val);
		$last	 = strtolower($val[strlen($val) - 1]);
		switch ($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
				break;
			default :
				$val = null;
		}
		return $val;
	}

	/**
	 *  Makes path safe for any OS for PHP
	 *
	 *  Paths should ALWAYS READ be "/"
	 * 		uni:  /home/path/file.txt
	 * 		win:  D:/home/path/file.txt
	 *
	 *  @param string $path		The path to make safe
	 *
	 *  @return string The original $path with a with all slashes facing '/'.
	 */
	public static function setSafePath($path)
	{
		return str_replace("\\", "/", $path);
	}

    /**
     *  Looks for a list of strings in a string and returns each list item that is found
     *
     *  @param array  $list		An array of strings to search for
     *  @param string $haystack	The string blob to search through
     *
     *  @return array An array of strings from the $list array found in the $haystack
     */
    public static function getListValues($list, $haystack)
    {
        $found = array();
        foreach ($list as $var) {
            if (strstr($haystack, $var) !== false) {
                array_push($found, $var);
            }
        }
        return $found;
    }

	/**
	 * Tests a CDN URL to see if it responds
	 *
	 * @param string $url	The URL to ping
	 * @param string $port	The URL port to use
	 *
	 * @return bool Returns true if the CDN URL is active
	 */
	public static function tryCDN($url, $port)
	{
		if ($GLOBALS['FW_USECDN']) {
			return DUPX_HTTP::is_url_active($url, $port);
		} else {
			return false;
		}
	}

	/**
	 *  Makes path unsafe for any OS for PHP used primarily to show default
	 *  Windows OS path standard
	 *
	 *  @param string $path		The path to make unsafe
	 *
	 *  @return string The original $path with a with all slashes facing '\'.
	 */
	public static function unsetSafePath($path)
	{
		return str_replace("/", "\\", $path);
	}

	 /**
     *  Sanitize input for XSS code
     *
     *  @param string $val		The value to sanitize
     *
     *  @return string Returns the input value cleaned up.
     */
    public static function sanitize($input)
    {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
	
	     /**
     *  Check PHP version
     *
     *  @param string $version		PHP version we looking for
     *
     *  @return boolean Returns true if version is same or above.
     */
    public static function isVersion($version)
    {
        return (version_compare(PHP_VERSION, $version) >= 0);
    }

    /**
     * @param $url string The URL whichs domain you want to get
     * @return bool|string The domain part of the given URL
     */
    public static function getDomain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if(strpos($domain,".") !== false){
            if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
                return $regs['domain'];
            }
        }else{
            return $domain;
        }

        return false;
    }

    public function getDefaultURL($url_to_replace,$main_url,$is_subdomain)
    {
        $new_url = $url_to_replace;
        $main_domain = self::getDomain($main_url);

        if(strpos($url_to_replace,$main_domain) !== -1){
            $currnet_path_arr = explode("/",$_SERVER['REQUEST_URI']);
            $count = count($currnet_path_arr);
            unset($currnet_path_arr[$count-1]);
            unset($currnet_path_arr[$count-2]);
            $path = implode("/",$currnet_path_arr);
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $current_url = $protocol.'://'.$_SERVER['HTTP_HOST'].$path;
            $current_domain = self::getDomain($current_url);
            if($is_subdomain){
                $new_url = str_replace(".$main_domain",".$current_domain",$new_url);
            }else{
                if(strpos($new_url,$main_url) !== false){
                    $new_url = str_replace($main_url,"$current_url/",$new_url);
                }else{
                    $new_url = str_replace("://$main_domain","://$current_domain",$new_url);
                }
            }

            $new_url = preg_replace("/^https?/",$protocol,$new_url);
        }

        return $new_url;
    }

    public function urlForSubdirectoryMode($subsiteArr,$url_old)
    {
        foreach ($subsiteArr as $key=>$subsite){
			$pattern_matched = preg_match('/^\//', $subsite->name);
			$is_path = !empty($pattern_matched);
            if($is_path) {
                $subsite->name = $url_old . $subsite->name;
                $subsiteArr[$key] = $subsite;
            }
        }

        return $subsiteArr;
    }

    public function appendProtocol($subsiteArr)
    {
        foreach ($subsiteArr as $key=>$subsite){
			$pattern_matched = preg_match('/^https?:\/\//', $subsite->name);
			$has_protocol = !empty($pattern_matched);
            if(!$has_protocol){
                $subsite->name = "http://".$subsite->name;
                $subsiteArr[$key] = $subsite;
            }
        }

        return $subsiteArr;
    }
}
DUPX_U::init();
