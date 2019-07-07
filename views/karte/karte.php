<?php
$_SESSION['returnTo'] = URL."karte";
if (isset($this->param)) {
    $nrzim = $this->param;
    echo "<div class=\"alert alert-danger text-center m-0\">$nrzim wurde gelöscht!</div>";
}
?>

<div class="content">
    <?php
    $karte = new Karte_Model();
    echo $karte->tabelleSchaffen($station);
    ?>
</div>