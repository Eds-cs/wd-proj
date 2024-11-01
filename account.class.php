<?php


require_once "database.php";

class Account{
    public $name ;
    public $email;
    public $password  ;
    public $account_type ;

    public $account_id;

    protected $db;

    function __construct() {
        $this->db = new Database;

    }

    function add(){
        $sql = "INSERT INTO accounts(name,email,password,account_type) VALUES(:name,:email,:password,:account_type)";
        $qry= $this->db->connect()->prepare($sql);
        $qry->bindParam("name", $this->name) ;
        $qry->bindParam("email", $this->email) ;
        $qry->bindParam("password", $this->password) ;
        $qry->bindParam("account_type", $this->account_type) ;

        if ($qry->execute()){
        return true;

        } else{
            return false;
        }
    }

    function showAll(){
        $sql = "SELECT * FROM accounts ORDER BY name ASC";
        $qry= $this->db->connect()->prepare($sql);
        $data = [];

        if ($qry->execute()){
            $data = $qry->fetchAll();
        }
        return $data;
}

function edit(){
    $sql = "UPDATE accounts SET name = :name, email = :email, password = :password, account_type = :account_type WHERE account_id = :account_id";
    $qry= $this->db->connect()->prepare($sql);
    echo $sql;
    $qry->bindParam(":name", $this->name) ;
    $qry->bindParam(":email", $this->email) ;
    $qry->bindParam(":password", $this->password) ;
    $qry->bindParam(":account_type", $this->account_type) ;
    $qry->bindParam(":account_id", $this->account_id) ;

        return $qry->execute();
        
}

function fetchRecordID($recordID){
$sql = "SELECT * FROM accounts WHERE account_id = :recordID";
$qry= $this->db->connect()->prepare($sql);
$qry->bindParam(":recordID", $recordID);

$data = [];
 if ($qry->execute()){
    $data = $qry->fetch();
}

return $data;
}

// function delete($recordID){
//     $sql = "DELETE FROM accounts WHERE account_id = :recordID";
//     $qry= $this->db->connect()->prepare($sql);
//     $qry->bindParam(":recordID", $recordID);
//     return $qry->execute();
// }



}

// $obj = new Account();

// echo "<pre>";
// print_r( $obj->showAll() );
// echo "</pre>";
//  $obj->add();
?>