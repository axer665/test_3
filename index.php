<?

require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php'); //Подключаемся к БД
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/fruits.php'); // Подключаем класс Фрукта
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/books.php'); // Подключаем класс книги
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/authors.php'); // Подключаем класс автора


// Создаём экземпляры классов
$fruits = new fruits();
$books = new books();
$authors = new authors();

// Строим HTML-таблицы
$tableOfFruits = 	"
						<table id='fruit_table' class='test_table'>
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
								<span id='fruits_message'></span>
							</td>
						</tr>
						</table>
					";



$tableOfBook = 	"
						<table class='test_table'>
							<tr>
								<th>
									Book
								</th>
								<th>
									Author
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
						<table class='test_table'>
							<tr>
								<th>
									Author
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

	<head>
		<link href="/css/style.css" rel="stylesheet">
		<title>
			Test
		</title>
	</head>

	<body>
		<!-- Выводим таблицы -->
			<?=$tableOfFruits?>
			<br/>
			<?=$tableOfBook?>
			<br/>
			<?=$tableOfAuthors?>
		
	</body>

	<script src="/js/jquery/jquery-3.4.1.min.js"></script>
	<script src="/js/script.js"></script>
</html>