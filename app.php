<?

class AppInit {
	function login() {
		echo Template::instance()->render('login.html');
	}
}

class App {
	// Calendar functions
	
	function monthView() {
		global $f3;
		
		$f3->set('date', $f3->get('PARAMS.date'));
		if ($f3->get('date') == "") $f3->set('date', date('Y-m'));

		// Set date for new entry
		$f3->set('dateNewEntry', $f3->get('date')."-01");

				
		get_events_month();
		echo Template::instance()->render('month.html');
	}
	
	function dayView() {
		global $f3;
		
		$f3->set('date', $f3->get('PARAMS.date'));
		if ($f3->get('date') == "") $f3->set('date', date('Y-m-d'));
		
		// Set date for new entry
		$f3->set('dateNewEntry', $f3->get('date'));

				
		get_events_day();
		echo Template::instance()->render('day.html');
	}
	
	function editEntry() {
		global $f3;
		
		$f3->get('db_events')->load('id='.$f3->get('PARAMS.id'));
		$f3->get('db_events')->copyto('POST');
		$f3->set('entryDate', $f3->get('POST.date'));
		
		switch ($f3->get('SESSION.user_level')) {
			case 3:
				echo Template::instance()->render('edit.html');
				break;
			case 2:
				echo Template::instance()->render('edit_crew.html');
			case 1:
				echo Template::instance()->render('edit_preview.html');
				break;
				}
	}

	function details() {
		global $f3;
		
		$f3->get('db_events')->load('id='.$f3->get('PARAMS.id'));
		$f3->get('db_events')->copyto('item');
		echo Template::instance()->render('details.html');
	}
	
	function newEntry() {
		global $f3;
		
		$f3->get('db_events')->insert();
		$f3->get('db_events')->copyto('POST');
		$f3->set('entryDate', $f3->get('PARAMS.date'));
		echo Template::instance()->render('edit.html');
	}
	
	function actionEntry() {
		global $f3;
		
		switch ($f3->get('POST.action')) {
			case "duplicate":
				$f3->get('db_events')->CopyFrom('POST');
				$f3->get('db_events')->id = "";
				$f3->get('db_events')->save();
				break;
			case "delete":
				$f3->get('db_events')->load('id='.$f3->get('POST.id'));
				$f3->get('db_events')->erase();
			case "save":
				if ($f3->get('POST.id') <> "") $f3->get('db_events')->load('id='.$f3->get('POST.id'));
				$f3->get('db_events')->CopyFrom('POST');
				$f3->get('db_events')->save();
		}

		echo Template::instance()->render('action_complete.html');
	}

	// Notes functions

	function notesView() {
		global $f3;
		
		get_notes();
		echo Template::instance()->render('notes.html');
	}


	function newNote() {
		global $f3;
		
		$f3->get('db_notes')->insert();
		$f3->get('db_notes')->copyto('POST');
		$f3->set('noteDate', $f3->get('PARAMS.date'));
		echo Template::instance()->render('edit_note.html');
	}
	
	function editNote() {
		global $f3;
		
		$f3->get('db_notes')->load('id='.$f3->get('PARAMS.id'));
		$f3->get('db_notes')->copyto('POST');
		$f3->set('noteDate', $f3->get('POST.date'));
		
		echo Template::instance()->render('edit_note.html');
	}

	function actionNote() {
		global $f3;
		
		switch ($f3->get('POST.action')) {
			case "duplicate":
				$f3->get('db_notes')->CopyFrom('POST');
				$f3->get('db_notes')->id = "";
				$f3->get('db_notes')->save();
				break;
			case "delete":
				$f3->get('db_notes')->load('id='.$f3->get('POST.id'));
				$f3->get('db_notes')->erase();
				break;
			case "save":
				if ($f3->get('POST.id') <> "") $f3->get('db_notes')->load('id='.$f3->get('POST.id'));
				$f3->get('db_notes')->CopyFrom('POST');
				$f3->get('db_notes')->save();
				break;
		}

		echo Template::instance()->render('action_complete.html');
	}


	
	function searchVeranst() {
		global $f3;
		
		$f3->set('search', ($f3->get('POST.searchveranst') <> "") ? $f3->get('POST.searchveranst') : "");		
		get_events_search_note();
		
		echo Template::instance()->render('search_veranst.html');
	}
	
	// Todos functions
	
	function todosView() {
		global $f3;
		
		get_todos();
		echo Template::instance()->render('todos.html');
	}
	
	function newToDo() {
		global $f3;
		
		$f3->get('db_todos')->insert();
		$f3->get('db_todos')->copyto('POST');
		$f3->set('POST.status', 'new');
		$f3->set('todoDate', $f3->get('PARAMS.date'));
		echo Template::instance()->render('edit_todos.html');
	}
	
	function editTodo() {
		global $f3;
		
		$f3->get('db_todos')->load('id='.$f3->get('PARAMS.id'));
		$f3->get('db_todos')->copyto('POST');
		$f3->set('todoDate', $f3->get('POST.date'));
		
		echo Template::instance()->render('edit_todos.html');
	}

	function actionTodo() {
		global $f3;
		
		switch ($f3->get('POST.action')) {
			case "duplicate":
				$f3->get('db_todos')->CopyFrom('POST');
				$f3->get('db_todos')->id = "";
				$f3->get('db_todos')->save();
				break;
			case "delete":
				$f3->get('db_todos')->load('id='.$f3->get('POST.id'));
				$f3->get('db_todos')->erase();
				break;
			case "save":
				if ($f3->get('POST.id') <> "") $f3->get('db_todos')->load('id='.$f3->get('POST.id'));
				$f3->get('db_todos')->CopyFrom('POST');
				$f3->get('db_todos')->save();
				break;
		}

		echo Template::instance()->render('action_complete.html');
	}

	
	// General functions
	
	function beforeroute() {
		global $f3;
		
		// Check if the user is logged in before any App execution.
		// Terminates if logged_in() returns FALSE.
		
		// Set dateNewEntry as a precaution.
		$f3->set('dateNewEntry', date("Y-m-d"));
		
		$ref = "";
		if (isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER'];
		$f3->set('backLink', $ref);
		
		return logged_in(); 
	}
	
	function search() {
		global $f3;
		
		$f3->set('search', ($f3->get('POST.search') <> "") ? $f3->get('POST.search') : "");
		
		get_events_search();
		get_notes_search();
		get_todos_search();
		echo Template::instance()->render('search.html');
	}
	
	function backup() {
		echo Template::instance()->render('backup.html');
	}

	function downloadBackup() {
		global $f3;
	
		$web = \Web::instance();
		$file = $f3->get('TEMP').'THCalBackup_'.date('Y-m-d').'.sql';
		$db_backup = backup_tables('localhost', $f3->get('DB_USER'), $f3->get('DB_PASS'), $f3->get('DB_NAME'), '*');
		file_put_contents($file, $db_backup);
		$sent = $web->send($file);
		unlink($file);
		
	}

	function about() {
		echo Template::instance()->render('about.html');
	}
	
	function logout() {
		global $f3;
		$f3->set('SESSION.token', '');
		setcookie('userToken', '');
		echo Template::instance()->render('login.html');
	}
}

?>