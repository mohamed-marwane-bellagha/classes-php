<?php
class user{
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    public function register($login, $password,$email,$firstname,$lastname){

        $db = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
        $test=$db->prepare("SELECT * FROM `utilisateurs` WHERE `login`='{$login}'");
        $test->execute();
        $testlogin=$test->fetchAll();
        if($testlogin==null){
            $query=$db->prepare("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('{$login}','{$password}','{$email}','{$firstname}','{$lastname}')");
            $query->execute();
            if($query==true){
                $newuser=[$login,$password,$email,$firstname,$lastname];
                return $newuser;
            }
        }
    }
    public function connect($login, $password){
        $db = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
        $query=$db->prepare("SELECT * FROM `utilisateurs`");
        $query->execute();
        $results=$query->fetchAll();
        for($i=0;isset($results[$i]);$i++){
            if($login==$results[$i][1] && $password==$results[$i][2]){
                $this->id=$results[$i][0];
                $this->login=$results[$i][1];
                $this->email=$results[$i][3];
                $this->firstname=$results[$i][4];
                $this->lastname=$results[$i][3];
                return $results[$i];
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
        $db= new PDO('mysql:host=localhost;dbname=classes','root','');
        $query=$db->prepare("DELETE FROM `utilsateurs` WHERE `login`='{$this->login}'");
        $query->execute();
    }
    public function update($login,$password,$email,$firstname,$lastname){
        $db= new PDO('mysql:host=localhost;dbname=classes','root','');
        $query=$db->prepare("UPDATE `utilisateurs` SET `login`='{$login}',`password`='{$password}',`email`='{$email}',`firstname`='{$firstname}',`lastname`='{$lastname}' WHERE `login`='{$this->login}'");
        $query->execute();
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
        $db= new PDO('mysql:host=localhost;dbname=classes','root','');
        $query=$db->prepare("SELECT `password` FROM `utilisateurs` WHERE `login`='{$this->login}'");
        $query->execute();
        $results=$query->fetch(PDO::FETCH_ASSOC);
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
        $db= new PDO('mysql:host=localhost;dbname=classes','root','');
        $query=$db->prepare("SELECT * FROM `utilisateurs` WHERE `login`='{$this->login}'");
        $query->execute();
        $results=$query->fetch(PDO::FETCH_ASSOC);
        $this->id=$results['id'];
        $this->login=$results['login'];
        $this->email=$results['email'];
        $this->firstname=$results['firstname'];
        $this->lastname=$results['lastname'];
    }
}
$ruben= new user();
$ruben->register('ruben','ruben','ruben@laplateforme','ruben','habib');
$ruben->connect('ruben','ruben');
?>