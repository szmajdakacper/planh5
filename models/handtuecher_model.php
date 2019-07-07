<?php
class Handtuecher_Model extends Model
{

  function __construct($nrzim, $anreiseStr, $abreiseStr)
  {
    $pdo = $GLOBALS['pdo'];
    $del_sql = "DELETE FROM ht WHERE nrzim = :nrzim";
    if($delete = $pdo->prepare($del_sql))
    {
      $delete->execute([":nrzim" => $nrzim]);
    }
    $anreise = new DateTime($anreiseStr);
    $abreise = new DateTime($abreiseStr);

    //if anreise or abreise are in Weekend
    if($anreise->format('w') == 6)
    {
      $anreise = $anreise->modify('+ 2 day');
    }
    elseif ($anreise->format('w') == 0) {
      $anreise = $anreise->modify('+ 1 day');
    }
    elseif ($abreise->format('w') == 6) {
      $abreise = $abreise->modify('- 1 day');
    }
    elseif ($abreise->format('w') == 0) {
      $abreise = $abreise->modify('- 2 day');
    }

    $erste_ht_wechsel = $anreise->modify('+ 7 day');

    //letzte ht wechsel -> eine Woche vor abreis
    switch($abreise->format('w'))
    {
      case 5:
        $letzte_ht_wechsel = $abreise->modify('- 4 day');
        break;
      case 4:
        $letzte_ht_wechsel = $abreise->modify('- 3 day');
        break;
      case 3:
        $letzte_ht_wechsel = $abreise->modify('- 2 day');
        break;
      case 2:
        $letzte_ht_wechsel = $abreise->modify('- 1 day');
        break;
      default:
        $letzte_ht_wechsel = $abreise;
    }


    $sql = "INSERT INTO ht VALUES (:nrzim, :ht_wechsel)";
    for($wechsel = $erste_ht_wechsel; $wechsel < $letzte_ht_wechsel; $wechsel->modify('+ 7 day'))
    {
      if($stmt = $pdo->prepare($sql))
      {
        $param = ["nrzim" => $nrzim, "ht_wechsel" => $wechsel->format('Y-m-d')];
        $stmt->execute($param);
      }
    }
  }
}
