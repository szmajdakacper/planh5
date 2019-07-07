<?php
  if (isset($this->param)) {
      $nrzim = $this->param['nrzim'];
  } else {
      $nrzim = "INVALID";
  }
?>

<div class="content p-5 text-center">
    <div class="form-group">
        <form action="<?php echo URL; ?>loeschen/loeschen" method="post">
            <h5 class="display-4">Wollen Sie Zimmer: <?php echo $nrzim; ?> löschen?</h5>
            <input class="btn btn-outline-success w-25" type="submit" id="submit" name="nein" value="Nein">
            <input class="btn btn-outline-danger w-25" type="submit" id="submit" name="ja" value="Ja">
            <input type="hidden" name="nrzim" value="<?php echo $nrzim; ?>">
        </form>
    </div>
</div>