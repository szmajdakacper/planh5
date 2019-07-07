<?php
class Liste_Model extends Model
{
    public function __construct()
    {
    }

    public function tabelleSchaffen()
    {
        $sql = "SELECT nrzim, anreise, abreise
            FROM aufenthalt
            ORDER BY nrzim";
        $pdo = $GLOBALS['pdo'];
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute();
            $html = "<div class=\"content\">";
            $html .= "<table class=\"table table-striped table-sm m-0\"><th>Nr: </th><th>Anreise: </th><th>Abreise: </th><th>Bearbeiten: </th><th>Löschen</th>";
            while ($zimmer = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $html .= "<tr><td>";
                $html .= $zimmer['nrzim'];
                $html .= "</td><td>";
                $html .= $zimmer['anreise'];
                $html .= "</td><td>";
                $html .= $zimmer['abreise'];
                $html .= "</td><td>";
                $html .= "<a href=\"".URL."bearbeiten/bearbeiten/".$zimmer['nrzim']."\">bearbeiten</a>";
                $html .= "</td><td>";
                $html .= "<a href=\"".URL."loeschen/fragen/".$zimmer['nrzim']."\">&times;</a>";
                $html .= "</td></tr>";
            }
            $html .= "</table></div>";
            echo $html;
        }
    }
}