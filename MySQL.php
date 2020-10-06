<?php
function connect()

{
    $host = 'localhost';
    $db   = 's66250_db'; // Имя БД
    $user = 's66250_dbuser';  // Имя пользователя БД
    $pass = 'w#k:e1x1ui#hucHv'; // Пароль БД
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $opt);

        return $pdo;
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
        return false;
    }
}
function user_DB_Check($usid)
{
    $pdo=connect();
    if($pdo){
           $stmt=$pdo->prepare('SELECT Position FROM users WHERE Id = ?');
            $stmt->execute([$usid]);
            if($stmt->rowCount()==0)
            {
                $st=$pdo->prepare('INSERT INTO users (Id,Position) VALUES(:usid,0)');
                $st->execute(array("usid"=>$usid));
            }
            else{
                return false;
            }
    }
}
function update_Columns($usid,$Position)
{
    $pdo=connect();
    if($pdo)
    {
        $stmt=$pdo->prepare('UPDATE users set Position = :value where Id = :usid');
        $stmt->execute(array("value"=>$Position,"usid"=>$usid));

    }
    return true;
}
function get_Position($usid){
    $pdo=connect();
    if($pdo){
        $stmt=$pdo->prepare('SELECT Position FROM users WHERE Id = ?');
        $stmt->execute([$usid]);
        $inf=[];
        foreach ($stmt as $row) {
            $inf['Position']=$row['Position'];
        }
        return $inf;
    }
    return false;
}

/*function check_table($usid)
{
    $pdo=connect();
     if($pdo){
        $usid='s'.$usid;
        $stmt=$pdo->prepare('SELECT Day_date FROM $usid WHERE Id =:usid');
        $stmt->execute(array("usid"=>$usid));
     if($stmt->rowCount()==0)
     {
    $st=$pdo->prepare('CREATE TABLE $usid (
    Id INT NOT NULL,
    Day_date DATE NOT NULL,
    Start_h VARCHAR(10) NOT NULL,
    End_h VARCHAR(10) NOT NULL,
    Breaks VARCHAR(6) NOT NULL,
    Eat VARCHAR(200) NOT NULL
    )');
    $st=$pdo->execute(array("usid"=>$usid);
     }
     else{
    return true;          ВОТ ЭТО ВСЕ НЕ РАБОТАЕТ
         }
    }
}*/