<?php
	require 'BooksController.php';
	// handles calls directly to the users subdirectory..


	F3::route('GET /Books', 'BooksController->books');
	F3::route('GET /Books/Genre/@genreId', 'BooksController->booksByGenre');
	F3::route('GET /Books/Book/@bookId', 'BooksController->bookDetails');


?>