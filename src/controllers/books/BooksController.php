<?php
	
	namespace php_boilerplate\controllers\books;

	class BooksController extends \php_boilerplate\controllers\BaseController {


		private function setupDB(){
			$connString =  "mysql:host=" . \F3::get("DBHost") . ";port=3306;dbname=" . \F3::get("DB");

			\F3::set('DB',
				new \DB(
					$connString,
					\F3::get("DBUsername"),
					\F3::get("DBPassword")
				)
			);

		}


		function books(){
			\F3::set('html_title', 'All Books');
			$this->setupDB();

			\F3::set('header','All of My Books');

			$books = new \Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$result = $books ->afind('','books.Title'); // ordering by Title..

			\F3::set('books', $result);

			\F3::set('content','books/list.html');

			

			echo \Template::serve('layout/site.html');
		}

		function booksByGenre(){
			\F3::set('html_title', 'Books By Genre');
			$this->setupDB();


			$books = new \Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$result = $books ->afind('genre_id='. \F3::get("PARAMS['genreId']"));

			\F3::set('books', $result);
			\F3::set('header', 'Books By Genre');

			\F3::set('content','books/list.html');

			

			echo \Template::serve('layout/site.html');
		}


		function bookDetails(){
			\F3::set('html_title', 'Book Details');
			$this->setupDB();
			$books = new \Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			$book = $books ->load('book_id='. \F3::get("PARAMS['bookId']"));

			\F3::set('book', $book);

			\F3::set('content','books/details.html');
			echo \Template::serve('layout/site.html');
		}

		function newBook(){
			\F3::set('html_title', 'Add a Book');
			$this->setupDB();
			$g = new \Axon('genres');

			\F3::set('genres', $g ->afind());

			\F3::set('content','books/newForm.html');
			echo \Template::serve('layout/site.html');
		}

		function saveBook(){
			$this->setupDB();

			\F3::input(
				'Title',
				function($val){
						return strlen($val) > 0 && strlen($val) <= 45;
				},
				''
			);
			\F3::input('Description',
					function($val){
						return strlen($val) <= 200;
					},'');


			// use request here because POST gets overwritten during validation steps.
			// scrub santizes the input so it can't do xss or injection..
			$data = \F3::scrub($_REQUEST);

			
			$book =  new \Axon('books');
			$book->GENRE_ID= $data['GenreID'];
			$book->TITLE = $data['Title'];
			$book->DESCRIPTION = $data['Description'];

			$book->save();


			\F3::reroute('/books');
		}
		function deleteBook(){
			$this->setupDB();
			$book = new \Axon("books");
			$book->load('book_id=' . \F3::get("PARAMS['bookId']"));
			$book->erase();
			\F3::reroute('/books');
		}


	}
?>