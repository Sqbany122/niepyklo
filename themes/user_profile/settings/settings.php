<?php include_once('/themes/inc/naglowek.php'); 
    if (!isset($_SESSION['login'])) {
        ?>
            <script>
                window.location = "/404.php";
            </script>
	    <?php
        die;
    }
    echo $_SERVER['REMOTE_ADDR'];
?>

    <div class="container settings w-100">

        <div class="row m-0">
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="flex-item flexBoxClass">
                    <div class="w-100 h-100 flexItemInsdeDiv">
                        <span>Profil</span>
                    </div>
                </div>
                <div class="flex-item flexBoxClass">
                    <a href="/ustawienia/awatar">
                        <div class="w-100 h-100 flexItemInsdeDiv">
                            <span>Awatar</span>
                        </div>
                    </a>
                </div>
                <div class="flex-item flexBoxClass">
                    <div class="w-100 h-100 flexItemInsdeDiv">
                        <span>Tło</span>
                    </div>
                </div>
                <div class="flex-item flexBoxClass">
                    <div class="w-100 h-100 flexItemInsdeDiv">
                        <span>Czarna lista</span>
                    </div>
                </div>
                <div class="flex-item flexBoxClass">
                    <div class="w-100 h-100 flexItemInsdeDiv">
                        <span>Hasło</span>
                    </div>
                </div>
                <div class="flex-item flexBoxClass">
                    <a href="/ustawienia/dostep">
                        <div class="w-100 h-100 flexItemInsdeDiv">
                            <span>Dostęp</span> 
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-5 ml-0 mr-0">
             
        </div>

    </div>

<?php require_once('/themes/inc/footer.php'); ?>