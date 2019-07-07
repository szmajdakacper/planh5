<?php
class Bettwaesche_Model extends Model
{

  function __construct($nrzim, $anreiseStr, $abreiseStr)
  {
    $pdo = $GLOBALS['pdo'];
    $del_sql = "DELETE FROM bw WHERE nrzim = :nrzim";
    if($delete = $pdo->prepare($del_sql))
    {
      $delete->execute([":nrzim" => $nrzim]);
    }
    $anreise = new DateTime($anreiseStr);
    $abreise = new DateTime($abreiseStr);

    $interval = $anreise->diff($abreise);
    //var_dump($interval->format( '%a' ));
    if($interval->format( '%a' ) < 28)
    {
      $bw_wechsel = $anreise->modify( '+ 10 day' );
    } else {
      $bw_wechsel = $anreise->modify( '+ 14 day' );
    }
    //echo $bw_wechsel->format('Y-m-d');

    if($bw_wechsel->format('w') == 6)
    {
      $bw_wechsel->modify('-1 day');
    } elseif($bw_wechsel->format('w') == 0) {
      $bw_wechsel->modify('+1 day');
    }
    //echo $bw_wechsel->format('Y-m-d');

    $sql = "INSERT INTO bw VALUES (:nrzim, :bw_wechsel)";
    if($stmt = $pdo->prepare($sql))
    {
      $param = [":nrzim" => $nrzim, ":bw_wechsel" => $bw_wechsel->format('Y-m-d')];
      $stmt->execute($param);
    }
  }
}
