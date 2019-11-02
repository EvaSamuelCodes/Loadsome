<?php

//This is the most recent version of my helpers library.
//Published 11/2/2019 under LGPL 3.
//Written by Evalynn Samuel

trait Helpers{

    public function pretty($thing = false) {
        if ($thing) {
            if (is_array($thing) || is_object($thing)) {
                print "<pre>\n";
                print_r($thing);
                print "</pre>\n";
            } else {
                print "<pre>";
                print $thing;
                print "</pre>";
            }
        }
    }

    public function get_dir($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath("{$dir}/{$value}");
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                get_dir($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    public function require_all($required_array = [])
    {
        if (count($required_array)) {
            foreach ($required_array as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

    }

    private function memory_usage($size): string {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    public function safe_redirect(string $url) {
        ob_start();
        ob_clean();
        ob_end_clean();
        header('Location: ' . $url);
        exit;
    }

    public function is_session_started(): bool {
        if (php_sapi_name() !== 'cli') {
            if (version_compare(phpversion(), '5.4.0', '>=')) {
                return session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                return session_id() === '' ? false : true;
            }
        }
        return false;
    }
    
    public function show_status_messages() {
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
