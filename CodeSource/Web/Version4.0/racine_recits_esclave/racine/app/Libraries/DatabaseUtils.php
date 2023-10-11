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

    public static function selectVisitByMonth()
    {
        $db = db_connect();
        $data = array();

        for ($i = 1; $i <= 12; $i++) {
            $result = $db->query("SELECT COUNT(*) AS nombre FROM Visite WHERE id_page = 13 AND MONTH(jour) = $i;");
            $row = $result->getRow();
            $data[] = $row->nombre;
        }

        return $data;
    }
}
