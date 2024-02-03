
<?php
class ConnectDb{
    private $servername ;
    private $username ;
    private $password ;
    private $dbname ;
    function __construct($servername, $username, $password, $dbname){
        $this->servername=$servername;
        $this->username=$username;
        $this->password=$password;
        $this->dbname=$dbname;

    }

        //method to connect with database

    function connectdb(){
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
       return $conn;
    }

    //method to do the insert query
    function insert($conn,$sql){
        if ($conn->query($sql) !== TRUE) {
          array_push(DataHandlingController::$errs,$conn->error);
          
        } 
          
      
    }

        //method to do the select query

    function select($conn,$sql){
      $result = $conn->query($sql);

      return $result;
          
      
    }

}