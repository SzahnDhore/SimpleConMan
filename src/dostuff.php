<?php
/**
 * This page is intended as a sort of swiss army knife of doing stuff.
 *
 * While the system has a Single Point of Entry through index.php, the user is redirected to this page whenever there is
 * stuff happening requiring $_POST data being sent. This could be writing to a database for instance.
 */

namespace SimpleConMan;

/**
 * For more info on these lines, please see index.php.
 */
error_reporting(E_ALL);
require_once 'system/x.autoloader.php';
Login::check();

/**
 * Checks to see what we want to do.
 */
$what_to_do = (isset($_POST['dostuff']) ? $_POST['dostuff'] : null);

/**
 * If nothing is specified to be done, nothing is done.
 */
if ($what_to_do === null) {
}

/**
 * Tries to log a user in.
 */
elseif ($what_to_do === 'logmein') {
    $user = (isset($_POST['login_form_input_username']) ? $_POST['login_form_input_username'] : '');
    $pass = (isset($_POST['login_form_input_password']) ? $_POST['login_form_input_password'] : '');
    $data = Login::tryLogin($user, $pass);
}

/**
 * Logs out a user.
 */
elseif ($what_to_do === 'logout') {
    Login::doLogout();
}

/**
 * Registers a new user.
 *
 * Validation and stuff will be added here.
 */
elseif ($what_to_do === 'register_user') {

    /**
     * We first need to check if the username or email is already in use.
     */
    $db = new Database;
    $users = $db->read('users', array('where' => array(
            'username' => $_POST['form_register_user_name'],
            'email' => $_POST['form_register_email'],
        ), ));

    /**
     * If they are, we throw a few alerts.
     */
    $duplicate_error = false;
    foreach ($users as $user) {
        if ($user['username'] == $_POST['form_register_user_name']) {
            Alerts::set('warning', 'Användarnamnet är upptaget.');
            $duplicate_error = true;
        }
        if ($user['email'] == $_POST['form_register_email']) {
            Alerts::set('warning', 'Epostadressen är redan registrerad. Välj en annan.');
            $duplicate_error = true;
        }
    }
    /**
     * If there is no conflict we encode the password and add the new user to the databse.
     */
    if ($duplicate_error === true) {
        header('Location: ' . Settings::main('base_url') . 'register.html');
    } else {
        $pass = new Password;
        $data = array(
            'email' => $_POST['form_register_email'],
            'username' => $_POST['form_register_user_name'],
            'password' => $pass->hashPass($_POST['form_register_password']),
        );
        $db_create = $db->create('users', $data);
        Alerts::set('info', 'Du är nu registrerad! För att logga in anger du epost/användarnamn och lösenord.', 'auto');
    }
}
header('Location: ' . Settings::main('base_url'));
// echo '<pre>';
// print_r($data);
//
// print_r($_POST);
// echo '</pre>';
