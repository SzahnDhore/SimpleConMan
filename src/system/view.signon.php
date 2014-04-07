<?php
namespace SimpleConMan;

// --- Takes care of user registration for the system
class Signon
{

    function __construct()
    {
        $this->lang = new HolQaH\Language;
    }

    public function signonForm()
    {
        $lang = $this->lang;
        return $lang->phrase('reg_text');
    }

}
