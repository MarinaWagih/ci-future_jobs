
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Change_langController extends CI_Controller {

public function index()

{

	if($_SESSION['lang'] == "en")
    {
        $_SESSION['lang'] = "ar";
    }
	else
    {
        $_SESSION['lang'] = "en";
    }
//    var_dump($_SESSION);
//    exit;
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

}

?>