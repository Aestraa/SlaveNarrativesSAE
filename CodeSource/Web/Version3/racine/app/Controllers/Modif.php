<?php

namespace App\Controllers;

class Modif extends BaseController
{
    public function modif()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        return view('resclaves/modif_recit', $data);
    }

    public function ModifRecit()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $nomR = $this->request->getPost('nomR');
        $idE = $this->request->getPost('idE');
        $lieuP = $this->request->getPost('lieuP');
        $infoSup = $this->request->getPost('infoSup');
        $dateP = $this->request->getPost('dateP');
        $typeR = $this->request->getPost('typeR');
        $pref = $this->request->getPost('pref');
        $com = $this->request->getPost('com');
        $modeP = $this->request->getPost('modeP');
        $prefD = $this->request->getPost('prefD');
        $nomS = $this->request->getPost('nomS');
        $lienR = $this->request->getPost('lienR');

        $idR = $_GET['idR'];

        $nomE = '';
        foreach ($data['auteurs'] as $elt) {
            if($elt['id_auteur'] == $idE){
                $nomE = $elt['nom'];
            }
        }  

        $sql = 'UPDATE `tab_recits_v3` SET `nom_esc` = ?, `titre` = ?, `date_publi` = ?, `lieu_publi` = ?, `mode_publi` = ?, `type_recit` = ?, `historiographie` = ?, `preface_blanc` = ?, `details_preface` = ?, `id_auteur` = ?, `scribe_editeur` = ?, `lien_recit` = ?, `debut_titre` = ? WHERE `id_recit` = ?';
        $db = db_connect();
        $db->query($sql, [$nomE, $nomR, $dateP, $lieuP, $modeP, $typeR, $com, $pref, $prefD, $idE, $nomS, $lienR, $nomR, $idR]);

        return redirect()->to('/recits');
    }
}
