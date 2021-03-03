<?
// Описываем класс автора, копирующий структуру из БД
class authors {
	private $id;
	public 	$book_title, 
			$author_id;

	public function getTable(){ // Метод, возвращающий данные для таблицы с количеством книг каждого автора
		$query = 	"	
						SELECT
							a.author_name,
							count(*) AS number_of_books
						FROM
							authors2 AS a INNER JOIN
							books2 AS b ON (a.id = b.author_id)
						GROUP BY
							a.id
					";
		return database::freeQueryDataback($query);
	}
}
?>