<?php
	include("admin/sniffer.php");
	if (!isset($cookieName)) :
		//установить куки
		setcookie($cookieName, $cookieValue, time()+$timeLimit);
	endif;
	//Узнать cookie
	#print_r($_COOKIE);
	//если удалён — новая запись
	if (!isset($_COOKIE['visitSite'])) {
		//куки не установлен
		saveData();
	}

?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>I. Внутренняя оптимизация.</title>
		<link rel="icon" href="img/favicon.ico" type="image/x-icon">
		<!--Описание стилей для меню, контента, подвала-->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/tabs.css">
		<!--Обмен данными с веб-сервером с помощью AJax-->
		<script src="js/index.js"></script>
	</head>
	<script type="text/javascript">
		var lastResFind=""; // последний удачный результат
		var copy_page=""; // копия страницы в ихсодном виде
		function TrimStr(s) {
			s = s.replace( /^\s+/g, '');
		return s.replace( /\s+$/g, '');
		}
		function FindOnPage(inputId) {//ищет текст на странице, в параметр передается ID поля для ввода
		var obj = window.document.getElementById(inputId);
		var textToFind;
		
		if (obj) {
			textToFind = TrimStr(obj.value);//обрезаем пробелы
		} else {
			alert("Введенная фраза не найдена");
			return;
		}
		if (textToFind == "") {
			alert("Вы ничего не ввели");
			return;
		}
		
		if(document.body.innerHTML.indexOf(textToFind)=="-1")
		alert("Ничего не найдено, проверьте правильность ввода!");
		
		if(copy_page.length>0)
				document.body.innerHTML=copy_page;
		else copy_page=document.body.innerHTML;

		
		document.body.innerHTML = document.body.innerHTML.replace(eval("/name="+lastResFind+"/gi")," ");//стираем предыдущие якори для скрола
		document.body.innerHTML = document.body.innerHTML.replace(eval("/"+textToFind+"/gi"),"<a name="+textToFind+" style='background:red'>"+textToFind+"</a>"); //Заменяем найденный текст ссылками с якорем;
		lastResFind=textToFind; // сохраняем фразу для поиска, чтобы в дальнейшем по ней стереть все ссылки
		window.location = '#'+textToFind;//перемещаем скрол к последнему найденному совпадению
		}
		</script>
 <body>
		<!--Верхний блок страницы: Меню-->

		<header>
			<div class="nav-scroll">
				<nav class="nav-scroll_items">
					<!--Ссылки на все вкладки-->
					<a class="nav-scroll_item" href="#about"   >LOREN</a>
					<a class="nav-scroll_item" href="#services">УСЛУГИ</a>
					<a class="nav-scroll_item" href="#reviews" >ОТЗЫВЫ</a>
					<a class="nav-scroll_item" href="#gallery" >ГАЛЕРЕЯ</a>
					<a class="nav-scroll_item" href="#answers" >FAQ</a>
					<a class="nav-scroll_item" href="#contacts">КОНТАКТЫ</a>
					<!--Конец ссылок-->
					
					<?php if(isset($_SESSION['user']['name']) && $_SESSION['user']['name'] != ''){ echo '<a class="nav-scroll_item" href="php/sign-out.php">ВЫХОД</a>';}
					else{ echo '<a class="nav-scroll_item" href="php/sign-in.php">ВХОД</a>';
					}
					?>
					<form>
						<input type="text" id="text-to-find" value="">
						<input type="button" onclick="javascript: FindOnPage('text-to-find'); return false;" value="Найти"/>
					</form>
				</nav>
			</div>
		</header>

		<!--Средний блок: Контент -->
		 
		<div class="separator"></div>
	<div class="content" id="content">
		<div class="main-content" id="about">
			<!-- начало контента -->
			<!-- Главная -->
			<div>
				<article>
					Наша дружная команда начала работу в 2008 году. За это время мы набрались опыта и набрали в свою команду лучших. Наши фотографы выезжают на свадьбы и снимают тематические вечеринки. Мы продолжаем развиваться и всегда готовы бросить вызов обыденности и скукоте! Ждем тебя в гости каждый день с 10 до 20
				</article>
				<button>Записаться!</button>
			</div>
			<img src="img/углы.png" width="400px">
		</div>
		<div class="separator"></div>
		<div class="main-content" id="services">
			<!-- УСЛУГИ -->
			<div><article>УСЛУГИ</article>
			<button>Волшебная фотосессия</button>
			<button>Ангелы</button>
			<button>Фотосессия с цветным дымом</button>
			<button>Весенняя фотосессия</button>
		
		</div>
		</div>
		<div class="separator"></div>
		<div class="main-content" id="reviews">
			<!-- ОТЗЫВЫ -->
			<div>
				<article>
					ОТЗЫВЫ<br>
					Пока нет ни одного отыва. Ваш будет первый!
				</article>
				<button>Написать отзыв!</button>
			</div>
		</div>
		<div class="separator"></div>
		<div class="main-content" id="gallery">
			<!-- ГАЛЕРЕЯ -->
			<div>
			<article>
			ГАЛЕРЕЯ
			</article>
			<div class="slider">
				<img class="img-gallery" src="img/ведьма.jpg" style="width: 300px">
				<img class="img-gallery" src="img/ангел.jpg" style="width: 300px">
				<img class="img-gallery" src="img/втумане.jpg" style="width: 300px">
				<img class="img-gallery" src="img/вцветах.jpg" style="width: 300px">
				<img class="img-gallery" src="img/шар_т.png" style="width: 300px">
			</div>
		</div>
		</div>
		<div class="separator"></div>
		<div class="main-content" id="answers">
			<!-- FAQ -->
			<div>
				<article>
					Принимаем все ваши вопросы на почту: loren-corp22@gmail.com
				</article>
				<!-- <button>Записаться!</button> -->
			</div>
		</div>
		<div class="separator"></div>
		<div class="main-content" id="contacts">
			<!-- КОНТАКТЫ -->
			<div>
				<article>
					КОНТАКТЫ<br>
					почта: loren-corp22@gmail.com<br>
					телефон: 8 800 900 40 50
				</article>
			</div>
		</div>
	</div>

	<div class="separator"></div>



	<!-- Блок сообщений пользователю -->
	<div id="loading" style="display: none">Идёт загрузка...</div>

	<!--Нижний блок (подвал): авторские права-->
	<footer class="Footer">
		<div class="text-block">&copy Колледж АлтГУ 2023 АГАПОВА Д.А.</div>
	</footer>
 </body>
</html>