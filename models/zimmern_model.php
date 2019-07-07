<?php
class zimmern_Model extends Model
{
    public function zimmerAddieren($data)
    {
        $nr = $data['nr'];
        $station = $data['station'];
        $zimmern = $this->selectZimmern();

        if (!(is_numeric($nr))) {
            $this->view->setParam("<div class=\"alert alert-danger text-center m-0\">Zimmernummer falsch!</div>");
            $this->view->render("zimmern/verfuegen");
            exit();
        } elseif (strlen($nr) == 2) {
            $nr = "0".$nr;
        } elseif (strlen($nr) == 1) {
            $nr = "00".$nr;
        } elseif (strlen($nr) > 3) {
            $this->view->setParam("<div class=\"alert alert-danger text-center m-0\">Zimmernummer falsch! - Korrekterweises Format: z.B. 001</div>");
            $this->view->render("zimmern/verfuegen");
            exit();
        }

        while ($zimmer = $zimmern->fetch()) {
            if ($zimmer['nrzim'] == $nr) {
                $this->view->setParam("<div class=\"alert alert-danger text-center m-0\">Zimmer ist schon im Datenbank!</div>");
                $this->view->render("zimmern/verfuegen");
                exit();
            }
        }
        
        $pdo = $GLOBALS['pdo'];
        $sql = "INSERT INTO zimmern VALUES (:nr, :station)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":nr", $nr);
            $stmt->bindParam(":station", $station);

            $stmt->execute();
        }

        header('Location:'.$_SESSION['returnTo']);
        exit();
    }

    public function zimmerLoeschen($nrzim)
    {
        $pdo = $GLOBALS['pdo'];
        $tables = ['zimmern', 'aufenthalt', 'ht', 'bw'];

        for ($i=0; $i < 4; $i++) {
            $sql = "DELETE FROM ".$tables[$i]." WHERE nrzim = :nrzim";

            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":nrzim", $nrzim);
    
                $stmt->execute();
            }
        }
        
        header('Location:'.$_SESSION['returnTo']);
        exit();
    }

    public function selectZimmern()
    {
        $pdo = $GLOBALS['pdo'];
        $sql = "SELECT nrzim, station
                FROM zimmern";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->execute();
        }

        return $stmt;
    }
    
    public function zimmern()
    {
        $table = "";
        //tabelle schaffen:
        $table = "<table class='table table-striped table-sm text-center'>";
        $table .= "<tr><th>Zimmernummer:</th><th>Station:</th><th>löschen:</th></tr>";
        
        $zimmern = $this->selectZimmern();
        if (is_null($zimmern)) {
            $this->view->setParam("<div class=\"alert alert-danger text-center m-0\">Kein Zimmer im Datenbank!</div>");
            $this->view->render("zimmern/verfuegen");
            exit();
        }
        
        while ($zimmer = $zimmern->fetch()) {
            $table .= "<tr>";
            $table .= "<td><p class='lead'>".$zimmer['nrzim']."</p></td>";
            $table .= "<td>";

            //dropdown for station:
            $table .= "<nav class='navbar'><ul class='navbar-nav mx-auto'>";
            $table .= "<li class='nav-item dropdown mx-5'>";
            $table .= "<a class='nav-link dropdown-toggle' data-toggle='dropdown'>Station ".$zimmer['station']."</a>";
            $table .= "<div class='dropdown-menu'>";
            for ($i=1; $i <= 8; $i++) {
                $table .= "<a href='".URL."zimmern/stationAendern/".$zimmer['nrzim']."/".$i."' class='dropdown-item'>Station $i</a>";
            }
            $table .= "</div></li></ul></nav></td>";
                
            //zimmerloeschen:
            $table .="<td>";
            $table .= "<a href='".URL."zimmern/zimmerLoeschen/".$zimmer['nrzim']."'> &times; </a>";
            $table .="</td>";

            $table .="</tr>";
        }
        $table .= "</table>";
        return $table;
    }

    public function stationAendern($nrzim, $neuStation)
    {
        $pdo = $GLOBALS['pdo'];

        $sql = "UPDATE zimmern 
                SET station = :station
                WHERE nrzim = :nrzim";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":station", $neuStation);
            $stmt->bindParam(":nrzim", $nrzim);

            $stmt->execute();
        }

        header('Location:'.$_SESSION['returnTo']);
        exit();
    }
}