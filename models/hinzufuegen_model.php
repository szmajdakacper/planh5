<?php
class Hinzufuegen_Model extends Model
{
    public function createSelect($table, $name)
    {
        $sql = "SELECT $name FROM $table";
        $pdo = $GLOBALS['pdo'];
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute();
            $select = "<select class=\"form-control form-control-lg text-center\" name=\"".$name."\"><option name=\"wählen\">Bitte Wählen</option>";
            while ($row = $stmt->fetch()) {
                $select .= "<option name=\"".$row[$name]."\">".$row[$name]."</option>";
            }
            $select .= "</select>";
        }
        echo $select;
    }

    public function addieren($data)
    {
        $this->checkEingabe($data);
        $this->insertToDatabase($data);
        
        $this->view->setParam("<div class=\"alert alert-success text-center m-0\">Zimmer: ".$data['nrzim']." wurde addiert!</div>");
        $this->view->render("hinzufuegen/hinzufuegen");
    }

    public function insertToDatabase($data)
    {
        require_once("models/handtuecher_model.php");
        require_once("models/bettwaesche_model.php");

        $nrzim = $data['nrzim'];
        $anreise = $data['anreise'];
        $abreise = $data['abreise'];
        //check if room is occupied
        $sql = "SELECT nrzim FROM aufenthalt WHERE nrzim = :nrzim";
        $pdo = $GLOBALS['pdo'];
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nrzim", $nrzim);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $sql_add = "UPDATE aufenthalt SET
                    anreise = :anreise,
                    abreise = :abreise
                    WHERE nrzim = :nrzim";
                if ($stmt_add = $pdo->prepare($sql_add)) {
                    $stmt_add->bindParam(":nrzim", $nrzim);
                    $stmt_add->bindParam(":anreise", $anreise);
                    $stmt_add->bindParam(":abreise", $abreise);
                    $stmt_add->execute();
                    $ht = new Handtuecher_Model($nrzim, $anreise, $abreise);
                    $bw = new Bettwaesche_Model($nrzim, $anreise, $abreise);
                }
            } else {
                //room is empty
                $sql_add = "INSERT INTO aufenthalt VALUES
                    (:nrzim, :anreise, :abreise)";
                if ($stmt_add = $pdo->prepare($sql_add)) {
                    //echo "$nrzim $anreise $abreise";
                    $stmt_add->bindParam(":nrzim", $nrzim);
                    $stmt_add->bindParam(":anreise", $anreise);
                    $stmt_add->bindParam(":abreise", $abreise);
                    $stmt_add->execute();
                    $ht = new Handtuecher_Model($nrzim, $anreise, $abreise);
                    $bw = new Bettwaesche_Model($nrzim, $anreise, $abreise);
                }
            }
        }
    }

    public function checkEingabe($data)
    {
        $nrzim = $data['nrzim'];
        $anreise = $data['anreise'];
        $abreise = $data['abreise'];

        if (!is_numeric($nrzim)) {
            $this->view->setParam("<div class=\"alert alert-danger text-center m-0\">Nicht gäwahlt!</div>");
            $this->view->render("hinzufuegen/hinzufuegen");
            exit();
        }

        $anrDate = new DateTime($anreise);
        $abrDate = new DateTime($abreise);
        $diff = $anrDate->diff($abrDate);

        if ($diff->format('%R%a') < 14) {
            $this->view->setParam("<div class=\"alert alert-danger text-center m-0\">Aufenthalt soll es minimum 14Tage sein!</div>");
            $this->view->render("hinzufuegen/hinzufuegen");
            exit();
        }
    }

    public function random_dates()
    {
        $heute = new DateTime();
        $heute_str = $heute->format('Y-m-d');
        
        $pdo = $GLOBALS['pdo'];
        $sql = "SELECT nrzim FROM zimmern";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute();
            while ($zimmer = $stmt->fetch()) {

                //Zimmernummer
                $data['nrzim'] = $zimmer['nrzim'];

                //generieren Anreise
                $anr = new DateTime($heute_str);
                $rand_tage = rand(0, 21);
                $anr = $anr->modify('- '.$rand_tage.' day');
                $data['anreise'] = $anr->format('Y-m-d');

                //generieren Abreise
                $rand_tage = rand(21, 30);
                $abr = $anr->modify('+ '.$rand_tage.' day');
                $data['abreise'] = $abr->format('Y-m-d');

                //addieren zu Database
                $this->insertToDatabase($data);
            }
        }

        header('Location:'.URL.'start');
    }
}