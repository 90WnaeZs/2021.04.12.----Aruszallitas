<?php

class db_oszt
{
    protected $db_host;
    protected $db_username;
    protected $db_pw;
    protected $db_con;

    function __construct()
    {
        $this->db_host="localhost";
        $this->db_username="root";
        $this->db_pw="";
    }

    function Connection($dbname)
    {
        try
        {
            $this->db_con=new PDO("mysql:host=$this->db_host;dbname=$dbname",$this->db_username, $this->db_pw);
            $this->db_con->exec("set names 'UTF-8'");
        }
        catch(PDOException $e)
        {
            die("Hiba az adatbázisban!");
        }
    }

    function Login($username,$pwd)
    {   
        $login_success=false;

        $res=$this->db_con->prepare("SELECT Nev,Jelszo FROM users WHERE Nev= :pNev AND Jelszo= :pJelszo");

        $res->bindparam("pNev",$username);
        $res->bindparam("pJelszo",$pwd);

        $row=$res->execute();
        $row=$res->fetch();

        if($row>0)
        {
            $login_success=true;
        }
        else{
            echo "<script>alert('Hibás felhasználónév, vagy jelszó!')</script>";
            $login_success=false;
            
        }
        return $login_success;
    }

    function Reg($reguser,$regpw)
    {
        $reg_success=false;

        $res=$this->db_con->prepare("INSERT INTO users (Nev,Jelszo) VALUES(?,?)");

        $res->bindparam(1,$reguser);
        $res->bindparam(2,$regpw);

        $row=$res->execute();

        if($row>0)
        {
            $reg_success=true;
        }
        else
        {
            $reg_success=false;
            
        }
        return $reg_success;
        
    }
}


?>