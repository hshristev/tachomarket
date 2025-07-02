<?php
// bootstrap.php

// 1) DEV: show all errors. Remove or wrap in an ENV check in production.
ini_set('display_errors', value: 1);
error_reporting(E_ALL);

// 2) A super‐simple header/footer with optional inline CSS.
//    No external base_url dependency.

if (! function_exists('template_header')) {
    /**
     * @param string $title      Page <title>
     * @param string $inlineCss  Optional CSS to inject in <head>
     */
    function template_header(string $title, string $inlineCss = ''): void {
        echo <<<HTML
<!DOCTYPE html>
<html lang="bg">
<head>
  <meta charset="utf-8">
  <title>{$title}</title>
HTML;
        if ($inlineCss !== '') {
            echo "\n  <style>{$inlineCss}</style>";
        }
        echo "\n</head>\n<body>\n";
    }
}

if (! function_exists('template_footer')) {
    function template_footer(): void {
        echo <<<HTML
</body>
</html>
HTML;
    }
}
