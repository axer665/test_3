<?
// Описываем класс книги, копирующий структуру из БД
class books{
	private $id;
	public 	$author_name;

	public function getNumberOfBooks($author_id){ // Метод получения количества книг автора
		$query = 	"	
						SELECT
							count(*) AS number_of_books
						FROM 
							books2 
						WHERE 
							author_id = {$author_id}
					";
		return database::returnOneField($query);
	}

	public function getTable(){ // Метод, возвращающий данные для таблицы с авторами книг
		$query = 	"	
						SELECT
							b.book_title,
							a.author_name
						FROM
							books As b INNER JOIN
							authors AS a ON (b.author_id = a.id)
					";
		return database::freeQueryDataback($query);
	}
}
?>