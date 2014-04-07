<?php
namespace SimpleConMan;

/**
 * This class takes care of login for the user. All users are users. Admins are users with benefits.
 */
class Login
{

    /**
     * Does login-related checks each time the function is called, which should be once on top of every page. Since
     * index.php is our Single Point of Entry we only need to call it from there.
     */
    public static function check()
    {
        // --- Makes sure a session is always in progress.
        if (!isset($_SESSION['session_has_started']) || $_SESSION['session_has_started'] !== true) {
            session_start();
            session_regenerate_id();
            $_SESSION['session_has_started'] = true;
        }

        // --- Checks if a logout has been requested.
        if (isset($_GET['logout']) || isset($_POST['logout'])) {
            self::doLogout();
        }
    }

    /**
     * Checks to see if the user is logged in or not.
     */
    public static function userIsLoggedIn()
    {
        return (isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'] === true ? true : false);
    }

    /**
     * Tries to log in the user.
     *
     * This might be a bit too hard-coded at the moment, but it will be made more flexible in time.
     */
    public static function tryLogin($user, $pass)
    {
        $lang = new HolQaH\Language;

        // --- If the user is already logged in, nothing happens.
        if (isset($_SESSION['user_is_logged_in']) && $_SESSION['user_is_logged_in'] === true) {
            Alerts::set('info', $lang->phrase('login_trylogin_alreadyloggedin'));
        } else {
            // --- If either user or password is empty we skip the login check.
            if ($user == '' || $pass == '') {
                if ($user == '') {
                    Alerts::set('warning', $lang->phrase('login_trylogin_username'));
                }
                if ($pass == '') {
                    Alerts::set('warning', 'You must provide a password.');
                }
            } else {
                // --- The provided password must be checked against the password hash in the database.
                $password = new Password;
                if ($password->checkPass($user, $pass) === true) {
                    // --- If it checks out the user is logged in.
                    self::doLogin();
                } else {
                    // --- If not, we make sure the user is logged out.
                    Alerts::set('danger', 'The provided username/email and password did not match. Please make sure you entered them correctly and try again.');
                }
            }
        }
    }

    /**
     * This checks access rights.
     *
     * It's much too simplistic at the moment. It will be rewritten to work with more advanced user rights and it will
     * probably be placed in the `User` class instead.
     */
    public static function access($required_role)
    {
        $actual_role = (self::userIsLoggedIn() ? 'user' : 'visitor');

        if ($required_role == 'visitor' || $actual_role === $required_role) {
            return true;
        } else {
            Alerts::set('warning', 'Sorry, but you don\'t have access to that page.', 'Access denied.');
            header('Location: index.php');
        }
    }

    /**
     * Completely nukes the current session, effectively logging the user out.
     */
    public static function doLogout()
    {
        $_SESSION['user_is_logged_in'] = false;
        unset($_SESSION);
        $_SESSION = array();
        session_destroy();
        session_start();
        $_SESSION['session_has_started'] = true;
    }

    /**
     * Logs in the user.
     */
    private static function doLogin()
    {
        session_regenerate_id();
        $_SESSION['session_has_started'] = true;
        $_SESSION['user_is_logged_in'] = true;
    }

}
