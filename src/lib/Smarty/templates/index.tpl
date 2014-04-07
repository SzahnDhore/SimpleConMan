<!DOCTYPE html>
<html lang="{$lang_iso6391}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{$head_title}</title>

        <link href="css/bootstrap-yeti.css" rel="stylesheet" />
        <link href="css/sticky-footer.css" rel="stylesheet" />
        <link href="css/conman.css" rel="stylesheet" />
        <link rel="shortcut icon" href="favicon.ico">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        {$head_custom}
    </head>

    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
{block name=top_menu}{/block}
        </div>
{block name=main_content}{/block}
{$alerts}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('*').tooltip({ placement: 'auto top' });
            });
        </script>
        {$alerts_js}
    </body>
</html>
