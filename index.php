<?
//Подключаемся к БД
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');

// Описываем класс Фрукта, копирующий структуру из БД
class fruits{
	
	private $id;
	public 	$name, 
			$weight;

	public function addNewFruit($name, $weight){ // Метод добавления нового фрукта
		$query = 	"	
						INSERT INTO 
							fruits 
								(`name`, `weight`)
						VALUES 
								('{$name}', {$weight})
					";
		return database::returnOneField($query);
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

// Создаём экземпляры классов
$fruits = new fruits();
$books = new books();
$authors = new authors();

// Строим HTML-таблицы
$tableOfFruits = 	"
						<table border='1' id='fruit_table'>
							<tr>
								<th>
									Fruit
								</th>
								<th>
									Weight
								</th>
							</tr>
					";

foreach ( $fruits->getTable() AS $k=>$v ){
	$tableOfFruits .= 	"
							<tr>
								<td>
									{$v['name']}
								</td>
								<td>
									{$v['weight']}
								</td>
							</tr>
						";
}

$tableOfFruits .=	"
						<tr id='block_button'>
							<td colspan='2'>
								<input type='button' value='Add fruit' id='add_fruit' data-trigger='add' />
							</td>
						</tr>
						</table>
					";



$tableOfBook = 	"
						<table border='1'>
							<tr>
								<th>
									Book
								</th>
								<th>
									Author of book
								</th>
							</tr>
					";

foreach ( $books->getTable() AS $k=>$v ){
	$tableOfBook .= 	"
							<tr>
								<td>
									{$v['book_title']}
								</td>
								<td>
									{$v['author_name']}
								</td>
							</tr>
						";
}

$tableOfBook .=	"
						</table>
					";


$tableOfAuthors = 	"
						<table border='1'>
							<tr>
								<th>
									Author of book
								</th>
								<th>
									Number of book
								</th>
							</tr>
					";

foreach ( $authors->getTable() AS $k=>$v ){
	$tableOfAuthors .= 	"
							<tr>
								<td>
									{$v['author_name']}
								</td>
								<td>
									{$v['number_of_books']}
								</td>
							</tr>
						";
}

$tableOfAuthors .=	"
						</table>
					";

?> 

<html>

	<header>
		<title>
			Test
		</title>
	</header>

	<body>
		<!-- Выводим таблицы ( без каких-либо стилей и скриптов... пока... ) -->
			<?=$tableOfFruits?>
			<br/>
			<?=$tableOfBook?>
			<br/>
			<?=$tableOfAuthors?>
		
	</body>
</html>