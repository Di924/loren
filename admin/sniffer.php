<?php
	$cookieName="visitSite"; //имя куки
	$cookieValue="1"; //значение куки
	$timeLimit=86400; //сутки
	//Функция записи данных о посетителе
	function saveData() {
		$fileName='admin/stat.txt'; //имя файла со статистикой
		date_default_timezone_set('Asia/Novosibirsk');
		$curTime=date("m.d.Y @ H:i:s"); //текущее время и дата
		//данные для записи
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$clientP = false;
		if (array_key_exists('REMOTE_ADDR', $_SERVER))
			$curIp = $_SERVER['REMOTE_ADDR'];
		$host = gethostname();
		$referer = false;
		if (array_key_exists('HTTP_REFERER', $_SERVER))
			$referer = $_SERVER['HTTP_REFERER'];
		if (empty($browser)) {$browser = "Unknown";}
		if (empty($curIP)) {$curIp = "Not Resolved";}
		if (empty($host)) {$host = "Unknown";}
		if (empty($referer)) {$referer = "No Referer";}
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http').
			'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$data_ = $browser."::".$curIp."::".$host."::".$referer."::".$url."::".$curTime."rn";
		//разделитель данных в строке --> две ":"
		//пишем в файл
		if ($fileName) :
			$fp = fopen($fileName, 'a+');
			fwrite($fp, $data_ . "\r\n");
			fclose($fp);
		endif;
	}
	//вывод данных из файла статистики
	function showStat() {
		$fileName="stat.txt";//имя  файла со статистикой
		//вывожу таблицу
		$fbase = file($fileName);
		$fbase = array_reverse($fbase);
		$count = sizeOf($fbase);
		echo "Всего посещений: $count<br><br>";
		echo "<div align='center'><table width='90%' border='1'>";
		echo "<tr><td width='30%'>Браузер + ОС</td>";
		echo "<td width='10%'>IP</td><td width='10%'>Хост</td>";
		echo "<td width='20%'>Ссылка</td><td width='15%'>Страница</td>";
		echo "<td width='15%'>Время визита</td></tr>";
		$maxVisitors=30; //кол-во отображаемых записей
		//цикл выполнится 30 раз
		for ($i=0; $i<$maxVisitors; $i++) :
			if ($i>=sizeof($fbase)) {break;}
			$s = $fbase[$i];
			//разделяю (и властвую)
			$strr = explode("::", $s);
			if (empty($strr)){break;}
			//вывожу данные
			echo "<tr><td>$strr[0]</td><td>$strr[1]</td>";
			echo "<td>$strr[2]</td><td>$strr[3]</td>";
			echo "<td>$strr[4]</td><td>$strr[5]</td></tr>";
		endfor;}
?>