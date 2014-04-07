<?php
namespace SimpleConMan\Pages;

/**
 * The class name is the same as the name of the page.
 */
class Register
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
        $out['template'] = 'jumbotron.tpl';
        $out['head_title'] = 'Registrera dig';
        $out['head_custom'] = '';
        $out['jumbotron'] = <<<EOF

        <h1 class="text-center">Registrera dig här...</h1>
        <p class="text-center">För att kunna anmäla dig till konventet måste du registrera dig på sidan. Fyll bara i informationen nedan så kan du börja använda systemet.</p>

EOF;
        $out['content'] = <<<EOF

        <div class="row">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6">
                <h2>Registrera dig här...</h2>
                    <form id="form-register" class="form-horizontal" role="form" action="dostuff.php" method="post">
                      <div class="form-group">
                        <label for="form_register_email" class="col-sm-3 control-label">Epostadress</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="form_register_email" name="form_register_email" placeholder="Epostadress">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="form_register_user_name" class="col-sm-3 control-label">Användarnamn</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="form_register_user_name" name="form_register_user_name" placeholder="Användarnamn">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="form_register_password" class="col-sm-3 control-label">Lösenord</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="form_register_password" name="form_register_password" placeholder="Lösenord">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-primary" name="dostuff" value="register_user">Registrera dig</button>
                        </div>
                      </div>
                      <input type="hidden"></input>
                    </form>
                 </div>
            <div class="col-md-3">&nbsp;</div>
        </div>

EOF;

        return $out;
    }

}
