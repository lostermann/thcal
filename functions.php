<?

// Establish database connection to SQL
$db = new DB\SQL('mysql:host=localhost;dbname='.$f3->get('DB_NAME'), $f3->get('DB_USER'), $f3->get('DB_PASS'));
$f3->set('db_events', new DB\SQL\Mapper($db, 'thcal'));
$f3->set('db_notes', new DB\SQL\Mapper($db, 'thcal_notes'));
$f3->set('db_todos', new DB\SQL\Mapper($db, 'thcal_todos'));

function logged_in() {
	global $f3;
	
	$db = new \DB\Jig ("data/");
	$db_mapper = new \DB\Jig\Mapper($db, 'users');
	$auth = new \Auth($db_mapper, array('id' => 'user', 'pw' => 'password'));
	
		
		if ($f3->get('REQUEST.username') <> "") {
			// User tries to log in
			if($auth->login($f3->get('REQUEST.username'), $f3->get('REQUEST.password'))) {
				// user/pw combination correct
				$user = $db_mapper->load(array('@user=?', $f3->get('REQUEST.username')));
				$f3->set('SESSION.token', $user['token']);
				$f3->set('SESSION.user_level', $user['level']);
				setcookie('userToken', $f3->get('SESSION.token'), time()+60*60*24*10);
				return true;
			} else {
				// user/pw combination incorrect
				$f3->set('SESSION.token', '');
				$f3->set('SESSION.user_level', '');
				echo Template::instance()->render('login_denied.html');
				return false;
			}
		} elseif ($f3->get('SESSION.token') <> "") {
			// A token is present.
			if($db_mapper->count(array('@token=?', $f3->get('SESSION.token'))) == 1) {
				// The token belongs to an actual user.
				return true;
			} else {
				// The SESSION.token does not match the user DB.;
				echo Template::instance()->render('session_expired.html');
				return false;
			}
		} elseif ($f3->get('COOKIE.userToken') <> "") {
			// User has a saved token cookie
			if ($db_mapper->count(array('@token=?', $f3->get('COOKIE.userToken'))) == 1) {
				// The token matches a user from the DB.
				$f3->set('SESSION.token', $f3->get('COOKIE.userToken'));
				$user = $db_mapper->load(array('@token=?', $f3->get('COOKIE.userToken')));
				$f3->set('SESSION.user_level', $user['level']);
				// Renew cookie.
				setcookie('userToken', $f3->get('SESSION.token'), time()+60*60*24*10);
				return true;
			} else {
				// The cookie was forged.
				echo Template::instance()->render('session_expired.html');
				return false;
			}	
		} else {
			// User is not logged in.
			$f3->set('SESSION.user_level', '');
			echo Template::instance()->render('session_expired.html');
			return false;
		}
}

function get_events_month() {
	global $f3;

	// Construct PREV and NEXT Link
		$f3->set('next_month', date('Y-m', strtotime($f3->get('date')." +1 month")));
		$f3->set('prev_month', date('Y-m', strtotime($f3->get('date')." -1 month")));
	
	// Get entries from DB
		$sql_limits = "date >= \"".$f3->get('date')."-01\" AND date < \"".$f3->get('next_month')."-01\"";	
		$f3->set('dates', $f3->get('db_events')->find($sql_limits, array("order" => "date ASC")));
}

function get_events_day() {
	global $f3;

	// Construct PREV and NEXT Link
		$f3->set('next_day', date('Y-m-d', strtotime($f3->get('date')." +1 day")));
		$f3->set('prev_day', date('Y-m-d', strtotime($f3->get('date')." -1 day")));
	
	// Get entries from DB
		$sql_limits = "date = \"".$f3->get('date')."\"";
		$f3->set('dates', $f3->get('db_events')->find($sql_limits, array("order" => "showtime ASC")));
	}

function get_events_search() {
	global $f3;

	// Get entries from DB
		$s = "%".$f3->get('search')."%";
		$f3->set('dates', $f3->get('db_events')->find(array('(veranstaltung LIKE ?) OR (bemerkung LIKE ?) OR (agentur LIKE ?) OR (tech_kontakt LIKE ?)', $s, $s, $s, $s), array("order" => "date ASC")));
	}

function get_events_search_note() {
	global $f3;

	// Get entries from DB
		$s = "%".$f3->get('search')."%";
		$f3->set('dates', $f3->get('db_events')->find(array('veranstaltung LIKE ?', $s), array("order" => "date DESC")));
	}

function get_notes_search() {
	global $f3;

	// Get entries from DB
		$s = "%".$f3->get('search')."%";
		$f3->set('notes', $f3->get('db_notes')->find(array('(title LIKE ?) OR (note LIKE ?)', $s, $s), array("order" => "date DESC")));
	}
	
function get_todos_search() {
	global $f3;

	// Get entries from DB
		$s = "%".$f3->get('search')."%";
		$f3->set('todos', $f3->get('db_todos')->find(array('(title LIKE ?) OR (kommentar LIKE ?)', $s, $s), array("order" => "date DESC")));
	}

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);

	$return = '';
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}

	return $return;
	
}

function get_notes() {
	global $f3;

	$f3->set('notes', $f3->get('db_notes')->find('', array("order" => "date DESC")));
}

function get_todos() {
	global $f3;

	$f3->set('todos', $f3->get('db_todos')->find('', array("order" => "status DESC")));
}

?>