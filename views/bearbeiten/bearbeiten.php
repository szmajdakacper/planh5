<script>
$(function() {
    $("#anreise").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#abreise").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
</script>

<?php
if (isset($this->param)) {
    $nrzim = $this->param['nrzim'];
    $anreise = $this->param['anreise'];
    $abreise = $this->param['abreise'];
} else {
    $nrzim = "INVALID";
    $anreise = "Err";
    $abreise = "Err";
}
?>

<div class="content bg-light p-5 text-center">
    <div class="form-group">
        <form action="<?php echo URL; ?>bearbeiten/aendern" method="post">
            <label for="nrzim">Zimmernummer: </label>
            <input class="form-control mb-3" type="text" name="nr" value="<?php echo $nrzim; ?>" disabled>
            <input type="hidden" name="nrzim" value="<?php echo $nrzim; ?>">
            <input class="form-control mb-3" type="text" id="anreise" name="anreise" value="<?php echo $anreise; ?>">
            <input class="form-control mb-3" type="text" id="abreise" name="abreise" value="<?php echo $abreise; ?>">
            <input class="btn btn-success btn-block mb-3" type="submit" id="submit" value="Ändern">
        </form>
    </div>
</div>