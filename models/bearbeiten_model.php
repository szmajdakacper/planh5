<?php
class Bearbeiten_Model extends Model
{
    public function bearbeiten($nrzim)
    {
        $pdo = $GLOBALS['pdo'];
        $sql = "SELECT nrzim, anreise, abreise
            FROM aufenthalt
            WHERE nrzim = :nrzim";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute([":nrzim" => $nrzim]);
            $zimmerDate = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $this->view->setParam($zimmerDate);
        $this->view->render("bearbeiten/bearbeiten");
    }

    public function aendern($date)
    {
        $pdo = $GLOBALS['pdo'];
        $nrzim = $date['nrzim'];
        $anreise = $date['anreise'];
        $abreise = $date['abreise'];
        $sql = "UPDATE aufenthalt SET
            anreise = :anreise,
            abreise = :abreise
            WHERE nrzim = :nrzim";
        if ($stmt = $pdo->prepare($sql)) {
            $parameters = [":anreise" => $anreise, ":abreise" => $abreise, ":nrzim" => $nrzim];
            if ($stmt->execute($parameters)) {
                require("models/handtuecher_model.php");
                require("models/bettwaesche_model.php");
                $ht = new Handtuecher_Model($nrzim, $anreise, $abreise);
                $bw = new Bettwaesche_Model($nrzim, $anreise, $abreise);
            } else {
                echo "Fehler beim Änderung";
            }
        }
        header('Location:'.$_SESSION['returnTo']);
    }
}