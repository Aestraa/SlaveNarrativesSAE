<?php

namespace App\Controllers;
 
use CodeIgniter\Exceptions\PageNotFoundException;
 
class Recits extends BaseController
{
    public function index()
    {

        $model = model(ModelRecit::class);
 
        $data = [
        'recits'  => $model->get5Recits(),
        ];

        return view ('resclaves/header')
        . view ('resclaves/recits',$data)
        . view ('templates/footer_resc');
    }

    public function view($idrec = null)
        {
            $model = model(ModelRecit::class);
            $texteArray = $model->getIdRec($idrec); // $texteArray est un tableau de valeurs

            // Tableau pour stocker les valeurs extraites
            $apiValues = array();

            // Parcourez chaque élément du tableau et appliquez le remplacement
            foreach ($texteArray as &$texte) {
                if (is_string($texte)) {

                    $commentaire = $texte;

                    $pattern = '/\(([^,]+),([^,]+),(\d+)\)/';

                    // Recherche des occurrences correspondantes dans la chaîne
                    if (preg_match_all($pattern, $texte, $matches, PREG_SET_ORDER)) {
                        foreach ($matches as $match) {
                            // Le deuxième groupe de capture ($match[2]) contient la valeur entre les deux virgules
                            $valeur = $match[2];
                            // Ajout de la valeur au tableau
                            $apiValues[] = $valeur;
                        }
                    }

                    // Utilisation d'une expression régulière pour rechercher et remplacer les caractères spéciaux par des liens
                    $texte = preg_replace_callback('/[()]/', function ($match) {
                        if ($match[0] === '(') {
                            return '<a href="javascript:void(0);" onclick="afficherPopup();">(';
                        } elseif ($match[0] === ')') {
                            return ')</a>';
                        }
                    }, $texte);

                    $indiceValeur = 0;

                    /*
                    *
                    *Ajout de titre racourci pour récupérer les informations de l'api
                    *
                    */

                    if ($apiValues != null){
                    
                        // Remplacement de chaque occurrence de 'afficherPopup()' par une variable différente
                        $texte = preg_replace_callback('/afficherPopup\(\)/', function ($match) use (&$indiceValeur, $apiValues) {
                            // Obtenez la valeur actuelle du tableau en utilisant l'indice courant
                                $valeur = $apiValues[$indiceValeur];
                            
                            
                            // Incrémentez l'indice de valeur pour passer à la suivante
                            $indiceValeur++;
                            
                            // Retournez la chaîne avec la valeur insérée dans les parenthèses
                            return "afficherPopup('" . $valeur . "')";
                        }, $texte);
                    }



                    $texte = htmlspecialchars_decode($texte);
                }
            }

            // Assigner le tableau $apiValues à $data['api']
            $data['api'] = $apiValues;

            $data['rec'] = $texteArray;

            if (empty($data['rec'])) {
                throw new PageNotFoundException('Cannot find the news item: ' . $idre);
            }

            return view('resclaves/header')
                . view('resclaves/view', $data)
                . view('templates/footer_resc');
        }


}
