<?php
namespace SimpleConMan\Pages;

/**
 * The class name is the same as the name of the page.
 */
class Index
{
    /**
     * Each time a page is requested, a check is made to see if the user has access to that page. This should be replaced
     * with a centrilized system later on, but for now it will suffice.
     */
    public function __construct()
    {
        \SimpleConMan\Login::access('visitor');
    }

    public function content()
    {
        $login = new \SimpleConMan\Loginform;
        $inline_form = $login->showForm(true);

        $out['template'] = 'jumbotron.tpl';
        $out['head_title'] = 'This is the index page.';
        $out['head_custom'] = '';
        $out['jumbotron'] = <<<EOF

<h1>Skall du delta på WSK'14?</h1>
<p>För att kunna delta på <abbr title="Wexio SpelKonvent 2014">WSK'14</abbr> och de arrangemang som hålls där måste du vara registrerad och anmäld i det här systemet. Du kan antingen göra det hemifrån direkt eller på plats på konventet.</p>
<p><a class="btn btn-primary btn-lg" role="button" href="register.html">Registrera dig direkt &raquo;</a></p>

EOF;
        $out['content'] = <<<EOF

            <div class="row">
                <div class="col-md-4">
                    <h2>Senaste nytt</h2>
                    <h3><small>WSK'14'</small></h3>
                    <p>Kvalomgångar för <abbr title="Svenska mästerskapen">SM</abbr> i <em>My Little Pony: <abbr title="Collectible Card Game">CCG</abbr></em> kommer att hållas under fredagen. Vinnaren är garanterad en plats i SM i Hälsingborg senare i år. Övriga deltagare har chans att komma in på poäng när alla kvalmatcher är avgjorda.</p>
                    <p><a class="btn btn-default" href="#" role="button">Mer om MLP:CCG &raquo;</a></p>
                    <h3><small>WSK'14'</small></h3>
                    <p>Nu är vår hemliga gäst bestämd och inbokad! Det är ingen mindre än... Eh, vänta lite bara medan jag kollar upp termen <em>'hemlig'</em> i min ordbok här...</p>
                </div>
                <div class="col-md-4">
                    <h2>Twitter</h2>
                    <h3><small>2014-03-21</small></h3>
                    <p>Ikväll blir det Cthulhu-kväll på BG. #Arkham Horror, Call of #Cthulhu CCG och mer.</p>
                    <h3><small>2014-03-21</small></h3>
                    <p>Ikväll blir det Cthulhu-kväll på BG. #Arkham Horror, Call of #Cthulhu CCG och mer.</p>
                    <p><a class="btn btn-default" href="#" role="button">Följ oss på Twitter &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>Logga in på sidan</h2>
                    {$inline_form}
                    <p>Om du inte har registrerat dig på sidan kan du göra det nedan.</p>
                    <h2>Registrera dig direkt!</h2>
                    <p>För att kunna anmäla dig till något av våra arrangemang måste du först registrera dig på den här sidan.</p>
                </div>
            </div>

EOF;

        return $out;
    }

}
