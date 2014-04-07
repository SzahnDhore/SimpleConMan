<?php
namespace SimpleConMan;

// --- Class for displaying the login form.
class Loginform extends Login
{

    public function showForm($inline = true, $display = 'always')
    {
        $loggedin = $this->userIsLoggedIn();

        if ($loggedin && $display === 'loggedout') {
            return null;
        } elseif (!$loggedin && $display === 'loggedin') {
            return null;
        } else {

            $lang = new HolQaH\Language;

            if ($inline) {
                $form = '
<form class="form" role="form" action="dostuff.php" method="post">';
            } else {
                $form = '
<form class="nav navbar-nav navbar-form" role="form" action="dostuff.php" method="post">';
            }

            if ($inline && !$loggedin) {

                $form .= '
    <div class="form-group">' . '
        <input type="text" placeholder="' . $lang->phrase('username') . '" class="form-control input-sm" name="login_form_input_username" />
        <input type="password" placeholder="' . $lang->phrase('password') . '" class="form-control input-sm" name="login_form_input_password" />
    </div>';
            }
            if ($inline && $loggedin) {
                $form .= '
    <p>Du är redan inloggad så det vore ingen idé att försöka igen. Om du vill logga in som någon annan måste du först logga ut.</p>';
            }
            if (!$inline && !$loggedin) {
                $form .= '
    <div class="form-group">
        <input type="text" placeholder="' . $lang->phrase('username') . '" class="form-control input-sm" name="login_form_input_username" />
        <input type="password" placeholder="' . $lang->phrase('password') . '" class="form-control input-sm" name="login_form_input_password" />
    </div>';
            }

            $form .= '
    <button type="submit" class="btn btn-' . ($loggedin ? 'danger' : 'primary') . ' btn-sm" name="dostuff" value="' . ($loggedin ? 'logout' : 'logmein') . '">' . $lang->phrase(($loggedin ? 'logout' : 'login')) . ' &nbsp; <span class="glyphicon glyphicon-log-' . ($loggedin ? 'out' : 'in') . '"></span></button>
</form>
';
            if (!$inline) {
                $form .= '<br />';

            }

            return $form;
        }
    }

}
