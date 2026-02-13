<?php
ob_start();
?>
<div class="container">
    <div class="alert alert-info">
        Test - Page edit profil fonctionne !
    </div>
</div>
<?php
$content = ob_get_clean();
Flight::render("layout", ["title" => "Modifier profil", "content" => $content]);
