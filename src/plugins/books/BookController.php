<?php
	
	namespace php_boilerplate\plugins\books;
	use \F3 as F3;
	use \Template as Template;
	use \php_boilerplate\plugins\books\data\Books as Books;

	class BookController extends \marshall\core\BaseController {

		function books(){
			F3::set('html_title', 'All Books');
			F3::set('header','All of My Books');
			$bookService = new Books();
			F3::set('books', $bookService->getBooks());
			F3::set('content','books/views/list.html');
			echo Template::serve('core/layout/site.html');
		}

		function booksByGenre(){
			F3::set('html_title', 'Books By Genre');
			$bookService = new Books();
			F3::set('books', $bookService->getBooksByGenre(F3::get("PARAMS['genreId']")));
			F3::set('header', 'Books By Genre');
			F3::set('content','books/views/list.html');
			echo Template::serve('core/layout/site.html');
		}


		function bookDetails(){
			F3::set('html_title', 'Book Details');
			$bookService = new Books();
			F3::set('book', $bookService->getBookDetails(F3::get("PARAMS['bookId']")));
			F3::set('content','books/views/details.html');
			echo Template::serve('core/layout/site.html');
		}



		function newBook(){
			F3::set('html_title', 'Add a Book');
			$bookService = new Books();
			F3::set('genres', $bookService->getGenres());
			F3::set('content','books/views/newForm.html');
			echo Template::serve('core/layout/site.html');
		}

		function saveBook(){
			F3::input(
				'Title',
				function($val){
						return strlen($val) > 0 && strlen($val) <= 45;
				},
				''
			);
			F3::input('Description',
					function($val){
						return strlen($val) <= 200;
					},'');


			// use request here because POST gets overwritten during validation steps.
			// scrub santizes the input so it can't do xss or injection..
			$data = F3::scrub($_REQUEST);

			$bookService = new Books();
			$bookService->saveBook($data);


			F3::reroute('/books');
		}
		function deleteBook(){
			$bookService = new Books();
			$bookService->deleteBook(F3::get("PARAMS['bookId']"));

			F3::reroute('/books');
		}		
	}
?>