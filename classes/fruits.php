<?
// Описываем класс Фрукта, копирующий структуру из БД
class fruits{
	
	private $id;
	public 	$name, 
			$weight;

	public static function addNewFruit($name, $weight){ // Метод добавления нового фрукта
		$query = 	"	
						INSERT INTO 
							fruits 
								(`name`, `weight`)
						VALUES 
								('{$name}', {$weight})
					";
		return database::freeQueryFeed($query);
	}

	public function getTable(){ // Метод, возвращающий данные для таблицы с фруктами
		$query = 	"	
						SELECT
							*
						FROM
							fruits
						WHERE
							weight >= 150
					";
		return database::freeQueryDataback($query);
	}
}
?>