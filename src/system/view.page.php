<?php
namespace SimpleConMan;

/**
 * Parses the URL and displays the corresponding page.
 */
class Page
{
    /**
     * Sets up the smarty templating engine.
     *
     * This function initializes smarty and sets up a few options and variables for it. I'm a bit amibivalent to if this
     * should be in here or in the settings file. On the one hand this is where I set it up, but on the other hand it
     * makes sense to only have one file for all settings, but on the third hand there are no real things for the user to
     * set here, but on the fourth hand I have a few things in the settings file that the user shouldn't have to change
     * either. It will stay here for now since this is where I began writing it.
     */
    private static function smarty()
    {
        $lang = new HolQaH\Language;
        $smarty = new \Smarty;

        // --- Any global settings for smarty goes here.
        $smarty->setTemplateDir('lib/smarty/templates');
        $smarty->setCompileDir('lib/smarty/templates_compile');
        $smarty->setCacheDir('lib/smarty/cache');
        $smarty->setConfigDir('lib/smarty/config');

        // --- Any global variables for smarty goes here.
        $smarty->assign('lang_iso6391', $lang->getinfo('iso6391'));
        $smarty->assign('top_menu', Menu::display());
        $smarty->assign('alerts', Alerts::display());
        $smarty->assign('alerts_js', Alerts::javaScript());

        $pw = new Password;
        $password = (isset($_GET['password']) ? $_GET['password'] : null);
        $password = ($password != null ? $pw->hashPass($password) : null);
        $password = ($password != null ? ' - ' . $password : '');
        $smarty->assign('password', $password);

        return $smarty;
    }

    /**
     * A function for displaying a certain page.
     *
     * This gathers all needed resources for displaying a page and then shows it.
     */
    public static function display()
    {
        $route = new Route;
        $page_name = $route->parse();
        $page_name = (isset($page_name['url'][0]) && $page_name['url'][0] != '' ? $page_name['url'][0] : '');

        $default_page = (Login::userIsLoggedIn() ? 'default_page_logged_in' : 'default_page_logged_out');

        if ($page_name == '' || $page_name == 'index') {
            $page_name = Settings::main($default_page);
        } else {
            $page_name = explode('.', $page_name);

            if (isset($page_name[1]) && $page_name[1] == 'html') {
                $page_name = $page_name[0];
            } else {
                $page_name = Settings::main($default_page);
            }
        }

        $page_class = 'SimpleConMan\Pages\\' . ucfirst($page_name);
        $page = new $page_class;

        $smarty = self::smarty();
        $page = $page->content();

        foreach ($page as $variable => $value) {
            $smarty->assign($variable, $value);
        }

        echo $smarty->display($page['template']);
    }

}
