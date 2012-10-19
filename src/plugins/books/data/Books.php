<?php
	
	namespace php_boilerplate\plugins\books\data;
	use \F3 as F3;
	use \Axon as Axon;
	use \DB as DB;
	use \Template as Template;
	use \marshall\core\Session as Session;

	class Books extends \marshall\core\BaseDAO {
		public function __construct(){
			parent::__construct();
		}


		function getBooks($orderBy = 'books.Title'){
			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			return $books->afind('',$orderBy); // ordering by Title..

		}

		function getBooksByGenre($genreID){
			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			return $books->afind('genre_id='. $genreID);
		}

		function getBookDetails($bookID){
			$books = new Axon('books');
			// NOTE there is a diffrence here from the official documentation; you must wrap your query in parentheses..
			$books->def('GENRE', '(SELECT genre FROM genres WHERE genres.genre_id=books.genre_id)');
			return $books->load('book_id='. $bookID);

		}

		function getGenres(){
			$g = new Axon('genres');
			return $g->afind();
		}

		function saveBook($data){
			$book =  new Axon('books');
			$book->GENRE_ID= $data['GenreID'];
			$book->TITLE = $data['Title'];
			$book->DESCRIPTION = $data['Description'];
			$book->save();
		}

		function deleteBook($bookID){
			$book = new Axon("books");
			$book->load('book_id=' . $bookID);
			$book->erase();			
		}
	}
?>