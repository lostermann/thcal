<?php


	// Initialize F3 Framework + Components
		$f3=require('lib/base.php');
		require("lib/db/jig.php");
		require("lib/web.php");
		require("lib/template.php");

		// Load Configuration
		$f3->config('config.ini');

		require('functions.php');
		require('ui_functions.php');
		require('app.php');



	// Define routes
		// Calendar Routes	
			$f3->route('POST|GET @monthView: /month/@date', 'App->monthView');
			$f3->route('POST|GET @currentMonth: /month', 'App->monthView');
			$f3->route('GET @dayView: /day/@date', 'App->dayView');
			$f3->route('GET @today: /today', 'App->dayView');
			$f3->route('GET @details: /details/@id', 'App->details');
		
			$f3->route('GET @editEntry: /edit/@id', 'App->editEntry');
			$f3->route('GET @newEntryD: /new/@date', 'App->newEntry');
			$f3->route('GET @newEntry: /new', 'App->newEntry');
			$f3->route('POST @actionEntry: /action', 'App->actionEntry');
		
		// Notes
			$f3->route('GET @notes: /notes', 'App->notesView');
			$f3->route('GET @newNote: /newnote', 'App->newNote');
			$f3->route('GET @newNoteD: /newnote/@date', 'App->newNote');
			$f3->route('GET @editNote: /editnote/@id', 'App->editNote');
			$f3->route('GET|POST @actionNote: /actionnote', 'App->actionNote');
			$f3->route('GET|POST @searchVeranst: /searchveranst', 'App->searchVeranst');
			
		// Todos
			$f3->route('GET @todos: /todos', 'App->todosView');
			$f3->route('GET @newTodo: /newntodo', 'App->newTodo');
			$f3->route('GET @newTodoD: /newtodo/@date', 'App->newTodo');
			$f3->route('GET @editTodo: /edittodo/@id', 'App->editTodo');
			$f3->route('GET|POST @actionTodo: /actiontodo', 'App->actionTodo');
		
		// General routes	
			$f3->route('POST|GET @search: /search', 'App->search');
			
		
		$f3->route('GET @backup: /backup', 'App->backup');
		$f3->route('GET @backup_download: /backup/download', 'App->downloadBackup');
		
		$f3->route('GET @about: /about', 'App->about');
		$f3->route('GET @login: /', 'AppInit->login');
		$f3->route('GET @logout: /logout', 'App->logout');

	$f3->run();

?>