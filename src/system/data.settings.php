<?php
namespace SimpleConMan;

/**
 * Provides a single place for all system wide settings.
 */
class Settings
{

    /**
     * All settings related to the database.
     *
     * @param string $setting Name of the setting you want to return.
     * @return string Returns the specified setting value or, if this fails, false.
     */
    public static function db($requested)
    {
        $settings = array(

            /**
             * What kind of database the system should use. Not yet implemented.
             */
            // 'database' => 'mysql',

            /**
             * Host address of the database.
             */
            'host' => 'localhost',

            /**
             * Name of the database.
             */
            'dbname' => 'conman',

            /**
             * Username for the database.
             */
            'username' => 'root',

            /**
             * Password for the database.
             */
            'password' => '',

            /**
             * A prefix to all tables can be used if your host does not allow for multiple databases.
             */
            'prefix' => 'conman-',
        );

        return (array_key_exists($requested, $settings) ? $settings[$requested] : false);
    }

    /**
     * Main settings for the system.
     *
     * All system-wide non-specific settings goes here.
     *
     * @param string $setting Name of the setting you want to return.
     * @return string Returns the specified setting value or, if this fails, false.
     */
    public static function main($requested)
    {
        $settings = array(

            /**
             * If pretty URLs should be used or not. Set this to 'true' if you use 'mod_rewrite' or similar.
             */
            'pretty_urls' => true,

            /**
             * Important note!
             *
             * You shouldn't need to edit anything in the document below this line, but there are a few settings that can
             * be tweaked here if you really need to. Doing so might break the system, but in some cases it might be what
             * fixes your system.
             */

            /**
             * Base URL for the script, relative to the 'index.php' file.
             */
            'base_url' => rtrim($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'], substr(strrchr($_SERVER['PHP_SELF'], '/'), 1)),

            /**
             * This is the default page when the user is logged out.
             */
            'default_page_logged_out' => 'index',

            /**
             * This is the default page when the user is logged in.
             */
            'default_page_logged_in' => 'dashboard',
            // 'default_page_logged_in' => 'index',

            /**
             * The following string is equal to one tab. Change it if you want the outputted code to indent differently.
             */
            'tab' => '  ',
        );

        return (array_key_exists($requested, $settings) ? $settings[$requested] : false);
    }

}
