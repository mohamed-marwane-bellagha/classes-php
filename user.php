<?php
class user{
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    public function register($login, $password,$email,$firstname,$lastname){
        $db=mysqli_connect("localhost","root","","classes");
        $req="SELECT * FROM `utilisateurs` WHERE `login`='{$login}'";
        $query=mysqli_query($db,$req);
        $checklogin=mysqli_fetch_all($query);
        if($checklogin==null){
            $req="INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('{$login}','{$password}','{$email}','{$firstname}','{$lastname}')";
            $query=mysqli_query($db,$req);
            $newuser=[$login,$password,$email,$firstname,$lastname];
            return $newuser;
        }
        }
    public function connect($login, $password){
        $db=mysqli_connect("localhost","root","","classes");
        $req="SELECT * FROM `utilisateurs`";
        $query=mysqli_query($db,$req);
        $all_results=mysqli_fetch_all($query);
        for($i=0;isset($all_results[$i]);$i++){
            if($all_results[$i][1]==$login && $all_results[$i][2]){
                $this->id=$all_results[$i][0];
                $this->login=$all_results[$i][1];
                $this->email=$all_results[$i][3];
                $this->firstname=$all_results[$i][4];
                $this->lastname=$all_results[$i][3];
                return $all_results[$i];
            }
        }

    }
    public function disconnect(){
        unset($this->id);
        unset($this->login);
        unset($this->email);
        unset($this->firstname);
        unset($this->lastname);
    }
    public function delete(){
        $db=mysqli_connect("localhost","root","","classes");
        $req="DELETE FROM `utilsateurs` WHERE `login`='{$this->login}'";
        $query=mysqli_query($db,$req);
    }
    public function update($login,$password,$email,$firstname,$lastname){
        $db=mysqli_connect("localhost","root","","classes");
        $req="UPDATE `utilisateurs` SET `login`='{$login}',`password`='{$password}',`email`='{$email}',`firstname`='{$firstname}',`lastname`='{$lastname}' WHERE `login`='{$this->login}'";
        $query=mysqli_query($db,$req);
    }
    public function isConnected(){
        if(isset($this->login)){
            return true;
        }
        if(!isset($this->login)){
            return false;
        }
    }
    public function getAllInfos(){
        $db=mysqli_connect("localhost","root","","classes");
        $req="SELECT `password` FROM `utilisateurs` WHERE `login`='{$this->login}'";
        $query=mysqli_query($db,$req);
        $results=mysqli_fetch_assoc($query);
        $results=[$this->id,$results['password'],$this->login,$this->email,$this->firstname,$this->lastname];
        return $results;
    }
    public function getLogin(){
        return $this->login;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function refresh(){
        $db=mysqli_connect("localhost","root","","classes");;
        $req="SELECT * FROM `utilisateurs` WHERE `id`='{$this->id}'";
        $query=mysqli_query($db,$req);
        $results=mysqli_fetch_assoc($query);
        $this->id=$results['id'];
        $this->login=$results['login'];
        $this->email=$results['email'];
        $this->firstname=$results['firstname'];
        $this->lastname=$results['lastname'];
    }
}


?>