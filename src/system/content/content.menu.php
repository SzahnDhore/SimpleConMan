<?php
namespace SimpleConMan;

/**
 * Displays a menu.
 */
class Menu
{
    /**
     * Prints a navbar for use with bootstrap.
     */
    public static function display()
    {
        $lang = new HolQaH\Language;
        $login = new Loginform;
        $base_url = Settings::main('base_url');
        $logged_in = $login->userIsLoggedIn();

        $html = '
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="' . $base_url . '">' . ($logged_in ? 'Inloggad som ' . $_SESSION['user_name'] : 'Anmälan WSK') . '</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="' . $base_url . 'about.html">Om systemet</a></li>
';
        if ($logged_in) {

            $html .= '
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mina sidor <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="active"><a href="' . $base_url . 'users/675849/details.html">Min profil</a></li>
                <li><a href="' . $base_url . 'users/675849/registration.html">Min anmälan</a></li>
                <li><a href="' . $base_url . 'users/675849/schedule.html">Mitt schema</a></li>
                <li class="divider"></li>
                <li>
';
            $html .= $login->showForm(false);
            $html .= <<<EOF
        </li>
              </ul>
            </li>
EOF;
        }
        $html .= <<<EOF
EOF;
        $html .= $login->showForm(false, 'loggedout');
        $html .= <<<EOF
          </ul>
        </div>
      </div>
EOF;

        return $html;
    }

}
