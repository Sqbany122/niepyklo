<?php include('/var/www/html/themes/inc/naglowek.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-10 p-0 text-left" style="margin: 150px auto;">
			<h1 class="text-center">Informacje o zmianach</h1> 

			<div class="changelogUpdateDiv text-left">
				<span class="changelogUpdateSpan">Wersja 1.1 Alpha</span>
				<div class="col-md-12 mt-2 border border-dark changelogListItems p-2">
					<p>- poprawiona została paginacja,</p>
					<p>- zmodyfikowany został wyglą ogólny. Usunięte zostały zaokrąglone krawędzie i lekka poprawa pasków z informacjami nad memami,</p>
					<p>- zmodyfikowana została podstrona konta użytkownika. Panel statystyk został teraz dostosowany do pełnej szerokości, a poniżej wyśiwetlają się wszystkie memy po 3 na rząd. Dodatkowo po najechaniu na mema wyświetla się jego liczba plusów,</p>
					<p>- poprawiona została wyszukiwarka. Można teraz wyszukiwać tagi za pomocą paska szukania oraz klikająć na tag znajdujący się przy memie,</p>
					<p>- dodana została zupełnie nowa podstrona, dzięki której użytkownik może się skontaktować z administracją za pomocą Discorda,</p>
					<p>- przepisany został adres podstrony wyszukiwania i jego schemat wygląda teraz następująco (/tag/nazwa_tagu),</p>
					<p>- poprawiona została paginacja na podstronie wyszukiwania mema po tagu. Struktura wygląda następująco /tag/nazwa_tagu/nr_podstrony,</p>
					<p>- poprawiona paginacja na stronie głównej oraz podstronie poczekalnie według schematu (/page/nr_strony - dla strony głownej) oraz (/numer_strony) dla poczekalni,</p>
					<p>- na wszystkich podstronach zaktualizowane zostały tagi "title" tak aby odpowiadały konkretnej podstronie,</p>
					<p>- do podstrony dodawania mema dodana została kolumna wyświetlająca się po prawej stronie zawierająca polecane tagi,</p>
					<p>- dodana została stopka z takimi podstronami jak (Regulamin i Polityka prywatności),</p>
				</div>	
			</div>

			<div class="changelogUpdateDiv text-left">
				<span class="changelogUpdateSpan">Wersja 1.0 Alpha</span>
				<div class="col-md-12 mt-2 border border-dark changelogListItems p-2">
					<p>- podstrona, na której można dodać avatar,</p>
					<p>- podgląd avatara przed dodaniem,</p>
					<p>- możliwość zmiany awatara.</p>
				</div>
			</div>	

		</div>
	</div>
</div>

<?php require_once('/var/www/html/themes/inc/footer.php');?>