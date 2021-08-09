<?php include_once('/themes/inc/naglowek.php'); 

if (!isset($_SESSION['login'])) {
    ?>
        <script>
            window.location = "/404.php";
        </script>
    <?php
    die;
}

?>

<div class="container access">
    <h1 class="mb-5">Dostęp</h1>
    <table class="accessTable text-center">
        <thead>
            <tr>
                <th class="text-center">IP</th>
                <th class="text-center">Ostatnie logowanie</th>
                <th class="text-center">Akcja</th>
            </tr>
        </thead>
        <tbody class="tBodyJs">
            <?php 
                $userLoginData = new UserLoginData($default_db);
                $userLoginData->showUserLoginData();
            ?>
        </tbody>
    </table>
</div>

<?php include_once('/themes/inc/footer.php'); ?>