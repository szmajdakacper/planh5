<?php
class Start_Model extends Model
{
    public function login($data)
    {
        $pdo = $GLOBALS['pdo'];
        $sql = "SELECT id FROM users 
                WHERE login = :login
                AND password = MD5(:password)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':login', $data['login']);
            $stmt->bindParam(':password', $data['pass']);
            
            if ($stmt->execute()) {
                $user = $stmt->rowCount();
                if ($user == 1) {
                    $_SESSION['LoggedIn'] = true;
                } else {
                    $_SESSION['LoggedIn'] = false;
                }
            }
        }
        header('Location:'.URL);
    }
}