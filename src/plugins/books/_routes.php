<?php

	// register the plugin:
	$plugin = new \php_boilerplate\plugins\books\_plugin();

	// define the plugin routes
	F3::route('GET /Books', '\php_boilerplate\plugins\books\BookReader->books');
	F3::route('GET /Books/Genre/@genreId', '\php_boilerplate\plugins\books\BookReader->booksByGenre');
	F3::route('GET /Books/Book/@bookId', '\php_boilerplate\plugins\books\BookReader->bookDetails');
	F3::route('GET /Books/New/Book', '\php_boilerplate\plugins\books\BookWriter->newBook');
	F3::route('POST /Books/Save/Book', '\php_boilerplate\plugins\books\BookWriter->saveBook');
	F3::route('POST /Books/Delete/Book/@bookId', '\php_boilerplate\plugins\books\BookWriter->deleteBook');


?>