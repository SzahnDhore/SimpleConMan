<?php
/**
 * This is the index file for the system. It is a Single Point of Entry, with every other file being called from this one
 * in one way or another. All important files will reside in directories protected by .htaccess, making them unreachable
 * from outside of this file.
 */

/**
 * The namespace of the system. Should be included on top of every PHP-file. This makes uing some classes a bit easier
 * since there might, at times, be conflicting names. By using nested namespaces I can get around that problem.
 */
namespace SimpleConMan;

/**
 * All errors should be reported during development. When the system is released, an error logger will be put in place
 * so that malicious users can't see any errors that might be exploitable. The system *should* be completely error free
 * at v1.0.0, but we all know that promises and software doesn't mix well. If you do find any bugs or security
 * vulnerabilities, please contact me so I can fix it.
 */
error_reporting(E_ALL);

/**
 * The autoloader will automagically `require_once` any file with the needed class, provided that classes and files are
 * named in a certain way. It is therefore, with a few exceptions, the only file we need to load manually.
 */
require_once 'system/x.autoloader.php';

/**
 * The `login` class takes care of everything login-related and the `check()` function will perform a few basic checks
 * each time it's called. Since this file is our Single Point of Entry we can be sure those checks are performed each
 * time a page is loaded.
 */
Login::check();

/**
 * This displays the actual content. The `display` function takes care of everything so we don't really need to evaluate
 * anything here or pass on any arguments. This adds a small layer of safety to the system.
 */
Page::display();
