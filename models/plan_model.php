<?php
/**
 *
 */
class Plan_Model extends Model
{
  private $dieseMontag;
  private $naechsteMontag;
  private $tagDerWoche;

  function __construct()
  {
    $this->tagDerWoche = ["MO", "DI", "MI", "DO", "FR"];
    $this->dieseMontag = new DateTime();
    $this->naechsteMontag = new DateTime();
    $heute = new DateTime();

    switch($heute->format('w'))
    {
      case 0:
        $this->dieseMontag->modify('- 6 day');
        $this->naechsteMontag->modify('+ 1 day');
      break;
      case 1:

        $this->naechsteMontag->modify('+ 7 day');
      break;
      case 2:
        $this->dieseMontag->modify('- 1 day');
        $this->naechsteMontag->modify('+ 6 day');
      break;
      case 3:
        $this->dieseMontag->modify('- 2 day');
        $this->naechsteMontag->modify('+ 5 day');
      break;
      case 4:
        $this->dieseMontag->modify('- 3 day');
        $this->naechsteMontag->modify('+ 4 day');
      break;
      case 5:
        $this->dieseMontag->modify('- 4 day');
        $this->naechsteMontag->modify('+ 3 day');
      break;
      case 6:
        $this->dieseMontag->modify('- 5 day');
        $this->naechsteMontag->modify('+ 2 day');
      break;
    }
    //echo "heute: ".$heute->format('d/m')." diese: ".$this->dieseMontag->format('d/m')." Nächste: ".$this->naechsteMontag->format('d/m');
  }

  function getDieseMontag(){
    return $this->dieseMontag;
  }

  function getNaechsteMontag(){
    return $this->naechsteMontag;
  }


  function datenAbrufen($station, $woche)
  {
    $pdo = $GLOBALS['pdo'];
    if ($woche == "naechste") {
      $tag = new DateTime($this->naechsteMontag->format('Y-m-d'));
    } else {
      $tag = new DateTime($this->dieseMontag->format('Y-m-d'));
    }

    //fetch abreise
    $tag_abr = new DateTime($tag->format('Y-m-d'));
    for ($i=0; $i < 5; $i++) {
      $sql = "SELECT zimmern.nrzim
              FROM aufenthalt
              JOIN zimmern ON aufenthalt.nrzim = zimmern.nrzim
              WHERE zimmern.station = :station
              AND aufenthalt.abreise = :abreise";
      if($stmt = $pdo->prepare($sql))
      {
        $stmt->bindParam(":station", $station);
        $derTag = $tag_abr->format('Y-m-d');
        $stmt->bindParam(":abreise", $derTag);
        $stmt->execute();
        $abreisen[$this->tagDerWoche[$i]] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      $tag_abr->modify('+ 1 Day');
    }
    //print_r($abreisen);

    //abreise from weekend append to abreise on monday
    $tag_abr_weekend = new DateTime($tag->format('Y-m-d'));
    $tag_abr_weekend->modify('- 2 Day');
    for ($i=0; $i < 2; $i++) {
      $sql = "SELECT zimmern.nrzim
              FROM aufenthalt
              JOIN zimmern ON aufenthalt.nrzim = zimmern.nrzim
              WHERE zimmern.station = :station
              AND aufenthalt.abreise = :abreise";
      if($stmt = $pdo->prepare($sql))
      {
        $stmt->bindParam(":station", $station);
        $derTag = $tag_abr_weekend->format('Y-m-d');
        $stmt->bindParam(":abreise", $derTag);
        $stmt->execute();
        while($abr_we = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $abreisen_weekend['nrzim'] = $abr_we['nrzim']."WE";
          array_push($abreisen['MO'], $abreisen_weekend);
        }
      }
      $tag_abr_weekend->modify('+ 1 Day');
    }
    //print_r($abreisen);


    //fetch ht
    $tag_ht = new DateTime($tag->format('Y-m-d'));
    for ($i=0; $i < 5; $i++) {
      $sql = "SELECT zimmern.nrzim
              FROM ht
              JOIN zimmern ON ht.nrzim = zimmern.nrzim
              WHERE zimmern.station = :station
              AND ht.ht_wechsel = :ht_wechsel";
      if($stmt = $pdo->prepare($sql))
      {
        $stmt->bindParam(":station", $station);
        $derTag = $tag_ht->format('Y-m-d');
        $stmt->bindParam(":ht_wechsel", $derTag);
        $stmt->execute();
        $ht_wechsel[$this->tagDerWoche[$i]] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      $tag_ht->modify('+ 1 Day');
    }
    //print_r($ht_wechsel);

    //fetch bw
    $tag_bw = new DateTime($tag->format('Y-m-d'));
    for ($i=0; $i < 5; $i++) {
      $sql = "SELECT zimmern.nrzim
              FROM bw
              JOIN zimmern ON bw.nrzim = zimmern.nrzim
              WHERE zimmern.station = :station
              AND bw.bw_wechsel = :bw_wechsel";
      if($stmt = $pdo->prepare($sql))
      {
        $stmt->bindParam(":station", $station);
        $derTag = $tag_bw->format('Y-m-d');
        $stmt->bindParam(":bw_wechsel", $derTag);
        $stmt->execute();
        $bw_wechsel[$this->tagDerWoche[$i]] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      $tag_bw->modify('+ 1 Day');
    }
    //print_r($bw_wechsel);

    return ["abr" => $abreisen, "ht" => $ht_wechsel, "bw" => $bw_wechsel];
  }

  function planSchaffen($station, $woche)
  {
    if ($woche == "naechste") {
      $tag = new DateTime($this->naechsteMontag->format('Y-m-d'));
    } else {
      $tag = new DateTime($this->dieseMontag->format('Y-m-d'));
    }

    //Table header
    $table = "<table id=\"plan\"><th></th>";
    for($i = 0; $i < 5; $i++)
    {
      $table .= "<th>".$this->tagDerWoche[$i]." ";
      $table .= $tag->format('d/m');
      $tag->modify('+ 1 Day');
      $table .= "</th>";
    }

    //Table content
    $derWoche = $this->datenAbrufen($station, $woche);
    //print_r($derWoche);
    //echo $derWoche['abr']['MO'][1]['nrzim'];

    //abreise
    $table .= "<tr>";
    $table .= "<td>Abr</td>";
    for ($i=0; $i < 5; $i++) {
      $table .= "<td>";
      foreach($derWoche['abr'][$this->tagDerWoche[$i]] as $abr)
      {
        $table .= $abr['nrzim']."<br>";
      }
      $table .= "</td>";
    }
    $table .= "</tr>";

    //ht
    $table .= "<tr>";
    $table .= "<td>HT</td>";
    for ($i=0; $i < 5; $i++) {
      $table .= "<td>";
      foreach($derWoche['ht'][$this->tagDerWoche[$i]] as $ht)
      {
        $table .= $ht['nrzim']."<br>";
      }
      $table .= "</td>";
    }
    $table .= "</tr>";

    //bw
    $table .= "<tr>";
    $table .= "<td>BW</td>";
    for ($i=0; $i < 5; $i++) {
      $table .= "<td>";
      foreach($derWoche['bw'][$this->tagDerWoche[$i]] as $bw)
      {
        $table .= $bw['nrzim']."<br>";
      }
      $table .= "</td>";
    }
    $table .= "</tr>";
    $table .= "</table>";
    echo $table;
  }
}
