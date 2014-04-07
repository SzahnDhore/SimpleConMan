<?php
namespace SimpleConMan;

/**
 * Registers a function for autoloading undefined classes.
 */
spl_autoload_register('SimpleConMan\autoloader');

/**
 * Will automagically `require_once` any PHP files needed.
 *
 * The function is called whenever we try to instansiate a new class. By specifying allowed folders and file name
 * patterns we can check for class files and automagically load them.
 *
 * Please note that this loader is NOT compliant with PSR-0.
 *
 * @param string $class The class that has been called.
 */
function autoloader($class)
{
    // --- Removes all namespaces from the class name, if there are any.
    $class = (substr(strrchr($class, '\\'), 1) == '') ? $class : substr(strrchr($class, '\\'), 1);
    $class = strtolower($class);

    // --- Directories where classes reside. Relative to root.
    $dirs = array(
        'system/',
        'lang/',
        'lib/' . $class . '/', // --- External libraries are put in 'lib/' in folders having the name of the main class.
        'system/content/',
    );

    $prefixes = array(
        'system/data.', // --- Classes that fetches and stores data.
        'system/logic.', // --- Classes that handle requests and data.
        'system/view.', // --- Classes that outputs data.
        'system/class.', // --- Generic classes having mixed roles.
        'system/content/page.', // --- Classes that contain specific HTML content.
        'system/content/content.', // --- Classes that contain generic HTML content.
        'lang/class.', // --- Generic classes having mixed roles.
        'lib/' . $class . '/', // --- Classes by other authors typically don't have prefixes.
    );

    $suffixes = array(
        '.inc.php',
        '.class.php',
        '.php',
    );

    // --- Checks for a file having the same name as the class in each specified directory and includes it.
    foreach ($prefixes as $prefix) {
        foreach ($suffixes as $suffix) {
            $file = $prefix . $class . $suffix;
            if (is_readable($file)) {
                require_once $file;
                break 2;
            }
        }
    }

}
