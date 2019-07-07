<?php
$_SESSION['returnTo'] = URL."hinzufuegen";
?>
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
$model = new Hinzufuegen_Model();
$today = new DateTime();
$today = $today->format('Y-m-d');
if (isset($this->param)) {
    echo $this->param;
}
?>

<div class="content bg-light text-center p-5">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form action="<?php echo URL; ?>hinzufuegen/addieren" method="post">
                    <label for="nrzim">Zimmernummer: </label>
                    <?php $model->createSelect("zimmern", "nrzim"); ?>
                    <br>
                    <label for="anreise">Anreise: </label>
                    <input class="form-control form-control-lg" type="text" id="anreise" name="anreise"
                        value="<?php echo $today; ?>">
                    <br>
                    <label for="abreise">Abreise: </label>
                    <input class="form-control form-control-lg" type="text" id="abreise" name="abreise"
                        value="<?php echo $today; ?>">
                    <br>
                    <input class="btn btn-outline-success btn-block btn-lg" type="submit" id="submit" value="Addieren">
                </form>

            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>