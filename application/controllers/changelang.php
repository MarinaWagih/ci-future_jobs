
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Changelang extends CI_Controller {

public function index()

{

	if($_SESSION['lang'] == "en")
$_SESSION['lang'] = "ar";


		else
			$_SESSION['lang'] = "en";

header('Location: ' . $_SERVER['HTTP_REFERER']);
}

}

?>