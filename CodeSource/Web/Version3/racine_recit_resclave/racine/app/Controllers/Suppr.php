<?php

namespace App\Controllers;

class Suppr extends BaseController
{
    public function suppr()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        return view('resclaves/suppr_recit', $data);
    }

    public function SupprRecit()
    {
        $idR = $_GET['idR'];

        $sql = 'DELETE FROM `tab_recits_v3` WHERE `id_recit` = ?';
        $sql = 'DELETE FROM points WHERE `points`.`id_recit` = ? ';
        $db = db_connect();
        $db->query($sql, [$idR]);

        return redirect()->to('/recits');
    }
}
