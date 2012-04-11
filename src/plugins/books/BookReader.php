<?php
	
	namespace php_boilerplate\plugins\books;
	use \F3 as F3;
	use \Template as Template;
	use \Axon as Axon;
	use \DB as DB;

	class BookReader extends \marshall\core\BaseController {


		private function setupDB(){
			$connString =  "mysql:host=" . F3::get("DBHost") . ";port=3306;dbname=" . F3::get("DB");

			F3::set('DB',
				new DB(
					$connString,
					F3::get("DBUsername"),
					F3::get("DBPassword")
				)
			);

		}


		function books(){
			F3::set('html_title', 'All Books');
			$this->setupDB();

			F3::set('header','All of My Books');

			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$result = $books->afind('','books.Title'); // ordering by Title..

			F3::set('books', $result);

			F3::set('content','books/views/list.html');

			

			echo Template::serve('core/layout/site.html');
		}

		function booksByGenre(){
			F3::set('html_title', 'Books By Genre');
			$this->setupDB();


			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$result = $books->afind('genre_id='. F3::get("PARAMS['genreId']"));

			F3::set('books', $result);
			F3::set('header', 'Books By Genre');

			F3::set('content','books/views/list.html');

			

			echo Template::serve('core/layout/site.html');
		}


		function bookDetails(){
			F3::set('html_title', 'Book Details');
			$this->setupDB();
			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$book = $books->load('book_id='. F3::get("PARAMS['bookId']"));

			F3::set('book', $book);

			F3::set('content','books/views/details.html');
			echo Template::serve('core/layout/site.html');
		}
	}
?>