<?

class App {
	function beforeroute() {
		global $f3;
		
		// Check if the user is logged in before any App execution.
		// Terminates if logged_in() returns FALSE.
		
		// Set newEntryDate as a precaution.
		$f3->set('dateNewEntry', '');
		
		$ref = "";
		if (isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER'];
		$f3->set('backLink', $ref);
		
		return logged_in(); 
	}
	
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
		
		$f3->get('db')->load('id='.$f3->get('PARAMS.id'));
		$f3->get('db')->copyto('POST');
		$f3->set('entryDate', $f3->get('POST.date'));
		
		switch ($f3->get('SESSION.user_level')) {
			case 3:
				echo Template::instance()->render('edit.html');
				break;
			case 2:
				echo Template::instance()->render('edit_crew.html');
				break;
				}
	}

	function details() {
		global $f3;
		
		$f3->get('db')->load('id='.$f3->get('PARAMS.id'));
		$f3->get('db')->copyto('item');
		echo Template::instance()->render('details.html');
	}
	
	function newEntry() {
		global $f3;
		
		$f3->get('db')->insert();
		$f3->get('db')->copyto('POST');
		$f3->set('entryDate', $f3->get('PARAMS.date'));
		echo Template::instance()->render('edit.html');
	}
	
	function actionEntry() {
		global $f3;
		
		switch ($f3->get('POST.action')) {
			case "duplicate":
				$f3->get('db')->CopyFrom('POST');
				$f3->get('db')->id = "";
				$f3->get('db')->save();
				break;
			case "delete":
				$f3->get('db')->load('id='.$f3->get('POST.id'));
				$f3->get('db')->erase();
			case "save":
				if ($f3->get('POST.id') <> "") $f3->get('db')->load('id='.$f3->get('POST.id'));
				$f3->get('db')->CopyFrom('POST');
				$f3->get('db')->save();
		}

		echo Template::instance()->render('action_complete.html');
	}
	
	function search() {
		global $f3;
		
		$f3->set('search', ($f3->get('POST.search') <> "") ? $f3->get('POST.search') : "");
		
		get_events_search();
		echo Template::instance()->render('search.html');
	}

	function backup() {
		echo Template::instance()->render('backup.html');
	}

	function backup_download() {
		global $f3;
	
		$web = \Web::instance();
		$file = $f3->get('TEMP').'THCalBackup_'.date('Y-m-d').'.sql';
		$db_backup = backup_tables('localhost', $f3->get('DB_USER'), $f3->get('DB_PASS'), $f3->get('DB_NAME'), 'thcal');
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