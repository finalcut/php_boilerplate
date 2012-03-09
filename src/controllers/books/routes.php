<?php
	require 'BooksController.php';
	// handles calls directly to the users subdirectory..


	F3::route('GET /Books', 'BooksController->books');
	F3::route('GET /Books/Genre/@genreId', 'BooksController->booksByGenre');
	F3::route('GET /Books/Book/@bookId', 'BooksController->bookDetails');
	F3::route('GET /Books/New/Book', 'BooksController->newBook');
	F3::route('POST /Books/Save/Book', 'BooksController->saveBook');
	F3::route('POST /Books/Delete/Book/@bookId', 'BooksController->deleteBook');


?>