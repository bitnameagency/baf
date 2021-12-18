<?php
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}

//constructor
require_once ("bitnameagencyframework/config/taskStarter.php");
taskStarter::Run();