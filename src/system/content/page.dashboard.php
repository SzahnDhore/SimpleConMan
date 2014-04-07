<?php
namespace SimpleConMan\Pages;

class Dashboard
{
    public function __construct()
    {
        \SimpleConMan\Login::access('user');
    }

    public function content()
    {
        $login = new \SimpleConMan\Loginform;
        $db = new \SimpleConMan\Database;
        $user_name = (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Kim Besökare');

        $user_name_romaji = \SimpleConMan\Japinator::encode($user_name, 0);
        $user_name_romaji = ucfirst($user_name_romaji);
        $user_name_katakana = \SimpleConMan\Japinator::encode($user_name, 1);

        $out['template'] = 'dashboard.tpl';
        $out['head_title'] = 'This is the dashboard page.';
        $out['head_custom'] = '<link href="css/dashboard.css" rel="stylesheet" />';
        $out['content'] = <<<EOF

        <div class="row">
            <h1 class="page-header"><span title="Välkommen tillbaka">おかえりなさい</span><span title="{$user_name_romaji}-san">{$user_name_katakana}さん</span></h1>
            <p>Du har nu lyckats med konststycket att logga in! Kanske inte så jättesvårt så länge man kommer ihåg sitt lösenord, men varje tillfälle att fira är ett bra tillfälle att fira.</p>
            <p>Oh, på tal om lösenord? Om du slarvar bort ditt så måste du återställa det. Vi krypterar det så in i bomben innan vi sparar det i vår databas så att ta reda på vad du har för lösenord tar typ hur många år som helst.</p>
        </div>

EOF;

        return $out;
    }

}
