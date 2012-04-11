<?php
	
	namespace php_boilerplate\plugins\books;
	use \F3 as F3;
	use \Template as Template;
	use \Axon as Axon;
	use \DB as DB;

	class BookWriter extends \marshall\core\BaseController {


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
		
		function newBook(){
			F3::set('html_title', 'Add a Book');
			$this->setupDB();
			$g = new Axon('genres');

			F3::set('genres', $g->afind());

			F3::set('content','books/views/newForm.html');
			echo Template::serve('core/layout/site.html');
		}

		function saveBook(){
			$this->setupDB();

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

			
			$book =  new Axon('books');
			$book->GENRE_ID= $data['GenreID'];
			$book->TITLE = $data['Title'];
			$book->DESCRIPTION = $data['Description'];

			$book->save();


			F3::reroute('/books');
		}
		function deleteBook(){
			$this->setupDB();
			$book = new Axon("books");
			$book->load('book_id=' . F3::get("PARAMS['bookId']"));
			$book->erase();
			F3::reroute('/books');
		}


	}
?>