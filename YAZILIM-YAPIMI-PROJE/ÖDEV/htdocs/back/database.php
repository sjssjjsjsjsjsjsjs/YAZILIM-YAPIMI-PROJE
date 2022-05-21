<?php

class Database
{
    public $table;
    private $db;

    function __construct($table)
    {
        $this->table = $table;

        $config = [
            'server'    => "localhost",
            'user'      => "root",
            'pw'        => "",
            'database'  => "database"
        ];

        $config = json_decode(json_encode($config));

        try {
            $this->db = new PDO("mysql:host=" . $config->server . ";dbname=" . $config->database, $config->user, $config->pw);
        } catch (PDOException $e) {
            // print $e->getMessage();
        }
    }

    function getTable($data = null)
    {
        if ($data == null) {
            $query = $this->db->query("SELECT * FROM ".$this->table, PDO::FETCH_ASSOC);
            return $query;
        }else{
            $query = $this->db->query("SELECT * FROM ".$this->table." WHERE ".$data[0]." = '".$data[1]."'")->fetch(PDO::FETCH_ASSOC);
            return $query;
        }
        
    }

    function addTable($data)
    {
        $query = $this->db->prepare("INSERT INTO " . $this->table . " SET kadi = ?, sifre = ?");
        $query->execute($data);
    }

    function removeTable($col, $id)
    {
        $query = $this->db->prepare("DELETE FROM " . $this->table . " WHERE " . $col . " = :id");
        $query->execute(array(
            'id' => $id
        ));
    }

    function updateTable($data, $where)
    {
        $sql = "";

        foreach ($data as $key => $value) {
            $sql .= " ".$key." = :".$key;
        }

        $query = $this->db->prepare("UPDATE " . $this->table . " SET ".$sql." Where ".$where);
        $query->execute($data);
    }

    function checkData($data)
    {
        $query = $this->db->query("SELECT * FROM ".$this->table." WHERE ".$data[0]." = '".$data[1]."'")->fetch(PDO::FETCH_ASSOC);
        return ($query ? true : false);
    }
}
