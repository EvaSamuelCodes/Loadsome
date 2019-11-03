<?php

//This is the most recent version of my helpers library.
//Published 11/2/2019 under LGPL 3.
//Written by Evalynn Samuel

trait Helpers
{

    /**
     * fix_address_string function
     * Sanitizes addresses.
     *
     * @param string $address
     * @return string
     */
    public function fix_address_string(string $address)
    {

        //Sanitize first
        $new_address = filter_var($address, FILTER_SANITIZE_STRING);

        //Reformat and return
        return preg_replace('/\s+/', '-', $new_address);

    }

    /**
     * pretty
     * Prints the contents of an array string or object in an unformatted sting.
     *
     * @param variable $thing
     * @return void
     */
    public function pretty($thing)
    {
        // if (strlen($thing)) {
        if (is_array($thing) || is_object($thing)) {
            print "<pre>\n";
            print_r($thing);
            print "</pre>\n";
        } else {
            print "<pre>";
            print $thing;
            print "</pre>";
        }
        // }
    }
    /**
     * get_dir
     * Returns a recursive list of an entire directory tree.
     *
     * @param string $dir
     * @param array $results
     * @return array
     */
    public function get_dir(string $dir, array &$results = [])
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath("{$dir}/{$value}");
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->get_dir($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    /**
     * require_all function
     * Requires all php files in a directory tree
     *
     * @param string $dirname
     * @return void
     */
    public function require_all(string $dirname = '')
    {
        $big_list = $this->get_dir($dirname);
        $required_files = [];
        $ignored_files = [
            PUBLIC_ROOT . '/config.php',
            PUBLIC_ROOT . '/index.php',
            PUBLIC_ROOT . '/system/Bootstrap.php',
            PUBLIC_ROOT . '/system/Core.php',
            PUBLIC_ROOT . '/lib/simple-orm/example.php',
        ];

        foreach ($big_list as $file) {

            //So, if we have a php file, and it's not on the ignore list, add it to the required files list.
            if (!strpos($file, 'view/') == -1) {
                $ending = substr($file, -4, 4);
                if ($ending == '.php' && !in_array($file, $ignored_files)) {
                    $required_files[] = $file;
                }
            }

        }
   
        if (count($required_files)) {
            foreach ($required_files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * memory_usage
     * Returns the memory footprint of your php application. Handy!
     *
     * @param int $size
     * @return string
     */
    private function memory_usage(int $size): string
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    /**
     * safe_redirect
     * cleans buffer and redirects to a url
     *
     * @param string $url
     * @return void
     */
    public function safe_redirect(string $url)
    {
        ob_start();
        ob_clean();
        ob_end_clean();
        header('Location: ' . $url);
        exit;
    }

    /**
     * is_session_started
     * Tells you if you're in an active session.
     *
     * @return boolean
     */
    public function is_session_started(): bool
    {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                return session_id() === '' ? false : true;
            }
        }
        return false;
    }
    /**
     * show_status_messages
     * An easy peasy way to display status messages from a simple session based array
     *
     * @return void
     */
    public function show_status_messages()
    {
        if (isset($_SESSION['messages'])) {
            if (count($_SESSION['messages'])) {
                foreach ($_SESSION['messages'] as $message) {
                    print "<div class=\"alert\">{$message}</div>";
                }
                unset($_SESSION['messages']);
            }
        }
    }
}
