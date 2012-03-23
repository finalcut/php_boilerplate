<?php
	// handles calls directly to the users subdirectory..


	F3::route('GET /Books', '\php_boilerplate\controllers\books\BooksController->books');
	F3::route('GET /Books/Genre/@genreId', '\php_boilerplate\controllers\books\BooksController->booksByGenre');
	F3::route('GET /Books/Book/@bookId', '\php_boilerplate\controllers\books\BooksController->bookDetails');
	F3::route('GET /Books/New/Book', '\php_boilerplate\controllers\books\BooksController->newBook');
	F3::route('POST /Books/Save/Book', '\php_boilerplate\controllers\books\BooksController->saveBook');
	F3::route('POST /Books/Delete/Book/@bookId', '\php_boilerplate\controllers\books\BooksController->deleteBook');


?>