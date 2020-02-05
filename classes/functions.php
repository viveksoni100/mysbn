<?
function to_ddmmyyyy($performdate){
	list($y, $d, $m) = explode('-', $performdate);
	$performdatex = $d . "/" . $m . "/" . $y;
	return $performdatex;
}

function to_ddmmyyyy_hhmmss($performdate){
	$takeleft = substr($performdate,0,10);
	list($y, $m, $d) = explode('-', $takeleft);
	$onlydate = $m . "/" . $d . "/" . $y;
	

	$onlytime = substr($performdate,-8);

	return $onlydate ." " . $onlytime;
}

function sendmail($emailto, $emailtoname, $emailfrom, $emailfromname, $emailsubject, $emailtemplate) {
	require_once "Mail.php";
	$from = $emailfromname . " <".$emailfrom.">";
	$to = $emailtoname . " <".$emailto.">";
	$subject = $emailsubject;
	$body = $emailtemplate;
	$host = "icomaster.co";
	$username = "notify@icomaster.co";
	$password = "notify@120#";
	$port = "25";
	$headers = array ('From' => $from,
	'To' => $to,
	'Subject' => $subject,
	'MIME-Version' => 1,
    'Content-type' => 'text/html;charset=iso-8859-1');
	$smtp = Mail::factory('smtp',
	array ('host' => $host,
		'port' => $port,
		'auth' => true,
		'username' => $username,
		'password' => $password));
	$mail = $smtp->send($to, $headers, $body);
	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
		return 0;
	} else {
	echo("<p>Message successfully sent!</p>");
		return 1;
	}


}

function dayinfo($date1,$date2) {

	$diff = abs(strtotime($date2) - strtotime($date1));

	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	if ($days==0){
		return ("<font color=green>Today</font>");
	}elseif ($days < 30) {
		return ($days . " Day Old");
	}elseif ($days > 30 || $days < 365) {
		return ($months . " Month Old");
	}elseif ($days > 365) {
		return ($years . " Year Old");
	}
}


function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
}

function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    for($i=0;$i<$length;$i++){
        $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
    }
    return $token;
}

function domain_exists($email, $record = 'MX'){
	list($user, $domain) = split('@', $email);
	return checkdnsrr($domain, $record);
}

function sluggable($str) {

    $before = array(
        'àáâãäåòóôõöøèéêëðçìíîïùúûüñšž',
        '/[^a-z0-9\s]/',
        array('/\s/', '/--+/', '/---+/')
    );
 
    $after = array(
        'aaaaaaooooooeeeeeciiiiuuuunsz',
        '',
        '-'
    );

    $str = strtolower($str);
    $str = strtr($str, $before[0], $after[0]);
    $str = preg_replace($before[1], $after[1], $str);
    $str = trim($str);
    $str = preg_replace($before[2], $after[2], $str);
 
    return $str;
}

function random_string($length) {
	$key = '';
	$keys = array_merge(range('a', 'z'));
  
	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}
  
	return $key;
  }

  function sendsms($Mobile, $TextMessage) {
	$url = "http://mobi1.blogdns.com/httpapi/httpapisms.aspx?UserID=aitechnologies&UserPass=Ait909@&MobileNo=".$Mobile."&GSMID=AItech&Message=".urlencode($TextMessage)."&UNICODE=TEXT&SCHNAME=Reg"; 
	$response = file_get_contents($url);
	return substr($response,0,3);
	// 100 is success
  }

  
?>