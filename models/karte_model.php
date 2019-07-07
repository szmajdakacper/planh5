<?php
class Karte_Model extends Model
{
    public function datenAbrufen($station)
    {
        $pdo = $GLOBALS['pdo'];
        $sql = "SELECT zimmern.nrzim, aufenthalt.anreise, aufenthalt.abreise, bw.bw_wechsel
            FROM zimmern
            JOIN aufenthalt ON zimmern.nrzim = aufenthalt.nrzim
            JOIN bw ON zimmern.nrzim = bw.nrzim
            WHERE zimmern.station = :station
            ORDER BY zimmern.nrzim";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":station", $station);
            $stmt->execute();

            while ($zimmer = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nrzim[] = $zimmer['nrzim'];
                $anreise[] = $zimmer['anreise'];
                $abreise[] = $zimmer['abreise'];
                $bw_wechsel[] = $zimmer['bw_wechsel'];
            }
            if (!isset($nrzim)) {
                return false;
            }

            //ht getrennt abrufen von Tabelle ht für jedes Zimmer
            for ($i = 0; $i < count($nrzim); $i++) {
                $sql_ht = "SELECT ht_wechsel FROM ht WHERE nrzim = :nrzim";
                $stmt_ht = $pdo->prepare($sql_ht);
                $stmt_ht->execute([":nrzim" => $nrzim[$i]]);
                $ht_wechsel = $stmt_ht->fetch(PDO::FETCH_NUM);
                $htDate = new DateTime($ht_wechsel[0]);
                switch ($htDate->format('w')) {
          case 1:
            $ht[] = "Montags";
            break;
          case 2:
            $ht[] = "Dinstags";
            break;
          case 3:
            $ht[] = "Mittwochs";
            break;
          case 4:
           $ht[] = "Donerstags";
           break;
          case 5:
           $ht[] = "Freitags";
           break;
        }
            }
        }

        return ["nrzim" => $nrzim, "anreise" => $anreise, "abreise" => $abreise, "bw_wechsel" => $bw_wechsel, "ht" => $ht];
    }

    public function tabelleSchaffen($station)
    {
        if (!($zimmer = $this->datenAbrufen($station))) {
            return "<div class=\"alert alert-danger text-center m-0\">Kein Zimmer ist belegt.</div>";
        }
        
        $tag_derWoche = ['SO', 'MO', 'DI', 'MI', 'DO', 'FR', 'SA'];

        $table = "<table class=\"table table-striped table-sm m-0\">";
        $table .= "<tr><th>Zimmernummer</th><th>Anreise</th><th>Handtücher</th><th>Bettwäsche</th><th>Abreise</th><th>Bearbeiten</th><th>Löschen</th></tr>";
        for ($i = 0; $i < count($zimmer['nrzim']); $i++) {
            $anreise_format = new DateTime($zimmer['anreise'][$i]);
            $bw_format = new DateTime($zimmer['bw_wechsel'][$i]);
            $bw_tag_derWoche = $tag_derWoche[$bw_format->format('w')];
            $abreise_format = new DateTime($zimmer['abreise'][$i]);
            $abreise_tag_derWoche = $tag_derWoche[$abreise_format->format('w')];
            $table .= "<tr>";
            $table .= "<td>".$zimmer['nrzim'][$i]."</td>";
            $table .= "<td>".$anreise_format->format('d/m')."</td>";
            $table .= "<td>".$zimmer['ht'][$i]."</td>";
            $table .= "<td>".$bw_format->format('d/m')." (".$bw_tag_derWoche.")"."</td>";
            $table .= "<td>".$abreise_format->format('d/m')." (".$abreise_tag_derWoche.")"."</td>";
            $table .= "<td><a href=\"".URL."bearbeiten/bearbeiten/".$zimmer['nrzim'][$i]."\">Bearbeiten</a></td>";
            $table .= "<td><a href=\"".URL."loeschen/fragen/".$zimmer['nrzim'][$i]."\">&times;</a></td>";
            $table .= "</tr>";
        }
        $table .= "</table>";

        return $table;
    }
}