<?php
class Book extends Axon {
	public function __construct() {
		$this->sync('books');
	}

	public function listByGenre(){
		DB::sql('select BOOK_ID, TITLE, GENRE FROM books b, genres g WHERE b.genre_id = g.genre_id ORDER BY genre;');
		return F3::get('DB')->result;
	}

}
?>