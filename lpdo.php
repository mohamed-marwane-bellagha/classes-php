<?php
class lpdo {
    private $id;
    public $db;
    public $dbname;
    public $query;
    public $request;
    public $result;


    public function __construct($host,$username,$password,$db){

        if(isset($this->db)){
            unset($this->db);
        }else{
            $this->db=mysqli_connect($host,$username,$password,$db);
            $this->dbname=$db;
            return $this->db;
    }

    }
    public function destructeur(){
        $this->db=null;
    }
    public function close(){
        $this->db=null;
    }
    public function execute($query,$typeoffetch){
        /*
         * FETCH_ASSOC=2
         * FETCH_BOTH=4
         * FETCH_BOUND=6
         * FETCH_CLASS=8
         * FETCH_GROUP=65536
         * FETCH_LAZY=1
         * FETCH_NUM=3
         * */
        $typeoffetch = "mysqli_fetch_".$typeoffetch;
        $this->request=$query;
        $this->query=mysqli_query($this->db,$this->request);
        $this->result=$typeoffetch($this->query);
        return ($this->result);
    }
    public function getLastQuery(){
        if(isset($this->request)){
        return $this->request;
        }else{
            return false;
        }
    }
    public function getLastResult(){
        if(isset($this->result)){
            return $this->result;
        }else{
            return false;
        }
    }
    public function getTables(){
        $this->request="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='BASE TABLE' AND TABLE_SCHEMA='{$this->dbname}'";
        $this->query=mysqli_query($this->db,$this->request);
        $this->result=mysqli_fetch_assoc($this->query);
        return $this->result;
    }
    public function getFields($table){
        $this->request="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$table}' AND TABLE_SCHEMA='{$this->dbname}'";
        $this->query=mysqli_query($this->db,$this->request);
        $this->result=mysqli_fetch_all($this->query);
        return $this->result;
    }



}


?>