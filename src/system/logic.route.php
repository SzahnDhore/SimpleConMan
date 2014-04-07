<?php

namespace SimpleConMan;

/**
 * Handles URL routing in the system.
 *
 * Makes sure we can use nice looking, SEO-friendly URL:s instead of having to muck about with $_GET too much.
 */
class Route
{
    /**
     * Parses a given URI into an array.
     *
     * If the system is set up using mod_rewrite (or equivalent) this function can parse the URL. It returns an array and
     * the values from it should be used to determine what page to send the user to.
     *
     * @param bool $parse_query If true, the function parses and returns any GET requests. If false it ignores them.
     * @param string $request_uri A specified URI to parse. If null, the function uses the user-requested URI.
     */
    public function parse($parse_query = false, $request_uri = null)
    {
        if (Settings::main('pretty_urls') === true) {

            $request_uri = ($request_uri === null ? $_SERVER['REQUEST_URI'] : $request_uri);

            if ($request_uri != $_SERVER['SCRIPT_NAME']) {
                $request_uri = explode('/', $request_uri);
                $script_name = explode('/', $_SERVER['SCRIPT_NAME']);

                foreach ($script_name as $key => $value) {
                    if ($request_uri[$key] === $value) {
                        unset($request_uri[$key]);
                    }
                }

                foreach ($request_uri as $url_part) {
                    // list($url_part) = explode('.', $url_part);
                    list($url_part) = explode('?', $url_part);
                    if ($url_part != '') {
                        $url_parts[] = strtolower($url_part);
                    }
                    $url_parts[0] = (!isset($url_parts[0]) || $url_parts[0] == '' ? 'index' : $url_parts[0]);
                }

                $out['url'] = $url_parts;
            } else {
                $out['url'] = array('index');
            }

            if ($parse_query) {
                $parsed_url = parse_url($_SERVER['REQUEST_URI']);
                if (isset($parsed_url['query'])) {
                    parse_str($parsed_url['query'], $parsed_query);
                    $out['get'] = $parsed_query;
                }
            }
        } else {
            $out = false;
        }

        return $out;
    }

}
