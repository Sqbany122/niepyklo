<?php if (isset($_SESSION['user_id']) and isset($_SESSION['login'])) { ?>
<main>
  <div class="container">
  <h1>Kontakt za pomocą Discorda</h1>
    <form action="/discord" method="POST" class="discordForm">
      <div class="row justify-content-center">
        <div class="col-lg-10 p-0">
            <input class="discordTitle border border-dark" required autocomplete="off" type="text" name="title" id="title" placeholder="Tytuł wiadomości">
          </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10 p-0">
          <textarea class="discordDescription border border-dark" required autocomplete="off" name="description" id="content" cols="30" rows="10" placeholder="Treść wiadomości"></textarea>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10 text-left p-0">
          <input class="discordSubmit border border-dark" type="submit" name="action" value="Wyślij wiadomość">
        </div> 
      </div>
    </form>
    <div class="row justify-content-center">
      <div class="col-lg-10 p-0">
        <div class="discordInfoLabel">
          <span>Informacja</span>
        </div>
      </div>
      <div class="col-lg-10 p-0">
        <div class="discordInfoDescription border border-dark text-left">
          <p class="pt-3 pl-3 pr-3">Wszystkie informacjie, które zostaną umieszczone w tym formularzu kontaktowym zostaną przesłane bezpośrednio na nasz serwer Discord, na przeznaczony do tego celu kanał tekstowy.</p>
        </div>
      </div>
    </div>
  </div> 
</main>
<?php 
} else {
  ?> 
    <script>
      window.location = "/login.php";
    </script>
  <?php 
} include_once('/themes/inc/footer.php'); ?>
