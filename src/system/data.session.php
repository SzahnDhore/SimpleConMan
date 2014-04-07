<?php
namespace SimpleConMan;

// --- Handles sessions.
class Session
{

    public static function start()
    {
    	if (!isset($_SESSION['sessionStarted'])) {
	        session_start();
    	}
    }

}
