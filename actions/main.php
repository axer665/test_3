<?
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php'); 
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/fruits.php');

// Не лучший, конечно, вариант, но в данном случае, рабочий
if ($_POST['command'] == "add_fruit"){
	if (isset($_POST['name']) && isset($_POST['weight'])){
		if ($_POST['name'] && $_POST['name'] != '' && $_POST['weight'] && $_POST['weight'] != ''){
			$name = $_POST['name'];
			$weight = (int)$_POST['weight'];
			echo fruits::addNewFruit($name , $weight);
		} else {
			echo 0;
		}
	} else
		echo 0;
}
?>