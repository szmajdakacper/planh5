<?php $_SESSION['returnTo'] = URL."plan";
$diese = "";
$naechste = "";

if (array_key_exists('woche', $_POST)) {
    $woche = $_POST['woche'];
    $$woche = "selected";
} else {
    $woche = "diese";
}

$plan = new Plan_Model();


//fetch current monday, friday & next monday, next friday
$dieseMontag = $plan->getDieseMontag();
$dieseFreitag = new DateTime($dieseMontag->format('Y-m-d'));
$dieseFreitag->modify('+ 4 day');

$naechsteMontag = $plan->getNaechsteMontag();
$naechsteFreitag = new DateTime($naechsteMontag->format('Y-m-d'));
$naechsteFreitag->modify('+ 4 day');

?>
<div class="content p-5 bg-light">
    <div class="row">
        <div class="col-md-8 mb-3 toPrint">
            <?php
                $plan->planSchaffen($station, $woche);
            ?>
        </div>
        <div class="col-md-4">
            <div class="form-inline">
                <form id="plan" method="post">
                    <label for="plan">Plan für: </label>
                    <select class="form-control form-control-sm m-3" name="woche">
                        <option value="diese" <?php echo $diese; ?>>
                            <?php echo $dieseMontag->format('d/m')." - ".$dieseFreitag->format('d/m'); ?></option>
                        <option value="naechste" <?php echo $naechste; ?>>
                            <?php echo $naechsteMontag->format('d/m')." - ".$naechsteFreitag->format('d/m'); ?></option>
                        <input class="btn btn-sm btn-outline-success m-3" id="submit" type="submit" value="Ändern">
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>