<?php
    $_SESSION['returnTo'] = URL."zimmern";
    if (isset($this->param)) {
        echo $this->param;
    }
?>
<div class="content bg-light">

    <form action="<?php echo URL; ?>zimmern/zimmerAddieren" method="post">
        <div class="form-row">
            <div class="col-2">
                <p class="lead mb-0 mx-2">Zimmer Addieren:</p>
            </div>
            <div class="col-4">
                <input type="text" name="nr" placeholder="Zimmernummer" class="form-control" max-length="3">
            </div>
            <div class="col-4">
                <select name="station" class="form-control">
                    <option value="1">Station: 1</option>
                    <option value="2">Station: 2</option>
                    <option value="3">Station: 3</option>
                    <option value="4">Station: 4</option>
                    <option value="5">Station: 5</option>
                    <option value="6">Station: 6</option>
                    <option value="7">Station: 7</option>
                    <option value="8">Station: 8</option>
                </select>
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-outline-success btn-block" value="addieren">
            </div>
        </div>
    </form>

    <?php
        $zimmern = new Zimmern_Model();
        echo $zimmern->zimmern();
    ?>
</div>