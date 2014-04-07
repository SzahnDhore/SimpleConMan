<?php
namespace SimpleConMan\Pages;

/**
 * The class name is the same as the name of the page.
 */
class About
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
        $md = new \Michelf\MarkdownExtra;
        $changelog = $md->defaultTransform(file_get_contents('CHANGELOG.md'));

        $out['template'] = 'jumbotron.tpl';
        $out['head_title'] = 'This is the abouuut page.';
        $out['head_custom'] = '';
        $out['jumbotron'] = <<<EOF

        <h1>Om Konventshanteraren</h1>

EOF;
        $out['content'] = <<<EOF

        <div class="row">
            <div class="col-md-12">
                <h2>Ett vanligt problem...</h2>
            </div>
            <div class="col-md-4">
                <p>Där står du. Du har ansvaret för anmälningen till en tillställning. Kanske räknar ni med att det dyker upp runt 200 personer totalt. Ni behöver givetvis något enkelt sätt att hålla koll på dem.</p>
                <p>Och utan att blinka väljer ni Excel.</p>
                <p>Visst, i princip alla har det programmet (eller LibreOffice, eller OpenOffice, eller liknande) och det känns enkelt att bara skriva ner alla deltagare för hand i det, men det är egentligen inte riktigt vad du ville ha. Lite som att spika i en skruv i en bräda. Det funkar givetvis, men det är långt ifrån optimalt.</p>
                <p>Vi hade samma problem. Vi ville ha en lösning som kunde fungera år efter år. En lösning som tog hand om föranmälan, anmälan på plats, förbokning av prylar och sovsalar och allt annat som kan tänkas behövas i ett någorlunda vettigt anmälningssystem. Ett system som var modernt och hade en kärna av säker kod och vettigt tänk.</p>
                <p>Så jag byggde ett eget.</p>
                <p>Det är inte helt perfekt än, men för varje version kommer det ett steg närmare. Om du är intresserad kan du läsa versionshistoriken här bredvid eller ladda ner källkoden via Git. Systemet är licensierat under GNU GPL 3.</p>
            </div>
            <div class="col-md-8">
                <div style="height:45em;overflow:auto;border:1px dashed #888;padding:0 1em 1em 1em;background:#eee;">
                    {$changelog}
                </div>
            </div>
        </div>

EOF;

        return $out;
    }

}
