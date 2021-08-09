<?php
include_once('themes/inc/naglowek.php');
// clicked on submit
if (isset($_POST["action"]) && $_POST["action"] === "Wyślij wiadomość") {

  // load Webhook
  require_once "../../LoadWebhook.php";

  $username   = $_SESSION['login'] ?? "Użytkownik Niepykło.pl";
  $title = $_POST["title"] ?? null;
  $description = $_POST["description"] ?? null;

  $msg = new DiscordWebhook($webhook["url"]);

  $embed = new DiscordEmbed();
  // basic settings
  $embed->setTitle($title, $title_url)->setDescription($description);

  $msg->setMessage($message)->setUsername($username)->setAvatar($avatar_url)->setEmbed($embed)->send();
  ?>
  <script>
 			window.location = "/discord";
 	</script>
  <?php
}

// load website
include "inc/page.inc.php";

?>