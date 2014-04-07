<?php
namespace SimpleConMan;

// --- Class for displaying a page.
class PageTemplate
{
    public static function pageFooter($customFoot = '')
    {
        $html = <<<EOF
            <footer id="footer">
                <p>SimpleConMan &copy; Staffan Lindsgård - Sidan använder <a href="http://getbootstrap.com/">bootstrap</a> - Vi har inga cookies. Än.</p>
            </footer>
EOF;

        return $html;
    }

}
