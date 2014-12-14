<?

$f3->set('months', array("Jänner", "Feber", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"));
$f3->set('weekdays', array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"));

$f3->set('format_date',
		function($d) {
		global $f3;
			$d2 = strtotime($d);
			$r= $f3->get('weekdays.'.date("w", $d2)).", ";
			$r.= date("j", $d2).".";
			return $r;
		 }
		 );
$f3->set('format_time',
	function($t) {
		$t2 = strtotime(date("Y-m-d")." ".$t);
		return date("H.i", $t2);
});

$f3->set('format_month',
	function($m) {
		global $f3;
		$d = strtotime($m."-01");
		return $f3->get('months.'.(date("n", $d)-1))." ".date("Y", $d);
	});

$f3->set('location_x',
	function($l, $x) {
		$r = "";
		if ($l == $x) $r = "<span class=\"fa fa-times fa-lg\"></span>";
		return $r;
});

$f3->set('location_checked',
	function($l, $x) {
		$r = "";
		if ($l == $x) $r = "checked";
		return $r;
});

$f3->set('location_word',
	function($w) {
		switch($w) {
			case "T":
				return "Turm"; break;
			case "K":
				return "Keller"; break;
			case "S":
				return "Salon"; break;
			case "n":
				return "none"; break;
		}
	});

$f3->set('location_class',
	function($w) {
		switch($w) {
			case "T":
				return "greenish"; break;
			case "K":
				return "reddish"; break;
			case "S":
				return "grey"; break;
			case "n":
				return "white"; break;
		}
	});

$f3->set('rider_checked',
	function($y) {
		$r = "";
		if ($y == "Y") $r = "checked";
		return $r;
});

$f3->set('rider_letter',
	function($y) {
		$r = "-";
		if ($y == "Y") $r = "Y";
		return $r;
});

$f3->set('extract_month',
	function($m) {
		$a = explode("-", $m);
		return $a[0]."-".$a[1];
});

$f3->set('lowercase',
	function($s) {
		return strtolower($s);
});
?>