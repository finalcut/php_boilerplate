<?php
	require_once 'controllers/BaseController.php';

	class BooksController extends BaseController {


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
			$result = $books ->afind();

			F3::set('books', $result);

			F3::set('content','books/list.html');

			

			echo Template::serve('layout/site.html');
		}

		function booksByGenre(){
			F3::set('html_title', 'Books By Genre');
			$this->setupDB();


			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$result = $books ->afind('genre_id='. F3::get("PARAMS['genreId']"));

			F3::set('books', $result);
			F3::set('header', 'Books By Genre');

			F3::set('content','books/list.html');

			

			echo Template::serve('layout/site.html');
		}


		function bookDetails(){
			F3::set('html_title', 'Book Details');
			$this->setupDB();
			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$book = $books ->load('book_id='. F3::get("PARAMS['bookId']"));

			F3::set('book', $book);

			F3::set('content','books/details.html');
			echo Template::serve('layout/site.html');
		}


	}
?>