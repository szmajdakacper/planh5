<?php
/**
 *
 */
class Loeschen_Model extends Model
{
    private $tabellen = ["aufenthalt", "ht", "bw"];

    public function fragen($nrzim)
    {
        $pdo = $GLOBALS['pdo'];
        $sql = "SELECT nrzim
            FROM aufenthalt
            WHERE nrzim = :nrzim";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute([":nrzim" => $nrzim]);
            $zimmerDate = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        $this->view->setParam($zimmerDate);
        $this->view->render("loeschen/loeschen");
    }

    public function loeschen($data)
    {
        if (!isset($data['ja'])) {
            header('Location:'.$_SESSION['returnTo']);
            exit();
        }
        $nrzim = $data['nrzim'];
        $pdo = $GLOBALS['pdo'];
        for ($i = 0; $i < count($this->tabellen); $i++) {
            $sql = "DELETE FROM ".$this->tabellen[$i]."
              WHERE nrzim = $nrzim";
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->execute();
            }
        }
        header('Location:'.$_SESSION['returnTo']);
        exit();
    }
}