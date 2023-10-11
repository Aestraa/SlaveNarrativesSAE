<?php

namespace App\Libraries;

class DatabaseUtils
{
    public static function insertVisit($page)
    {
        if(!isset($_POST['isLanguageChanged'])){

        $db = db_connect();
        $jour = date('Y-m-d H:i:s');
        $result = $db->query("SELECT id FROM Page WHERE nom = '$page'");

        if ($result->getNumRows() > 0) {
            $row = $result->getRow();
            $id_page = $row->id;

            $sql = "INSERT INTO `Visite` (`jour`, `id_page`) VALUES ('{$jour}', '{$id_page}')";
            $db->query($sql);
        }
    }
    }
}