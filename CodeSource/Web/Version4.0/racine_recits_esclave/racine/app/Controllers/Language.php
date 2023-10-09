<?php namespace App\Controllers;

class Language extends BaseController {
    protected $session;
    protected $language;

    public function __construct() {

        $this->session = \Config\Services::session();
    }

    public function changeLanguage($lang) {
        // Vérifiez que la langue est valide
        $supportedLanguages = ['fr', 'en']; // Ajoutez les langues prises en charge
        if (!in_array($lang, $supportedLanguages)) {
            $lang = $this->request->getLocale();
        }

        // Définir la langue dans la session
        $this->session->set('locale', $lang);

        if((isset($_POST['idE']) && $_POST['idE'] != null) || (isset($_POST['boutonaj']) && $_POST['boutonaj'] != null)){
              //on redirige avec la méthode post
              echo '<body><script>
              const form = document.createElement("form");
              form.method = "post";
              form.action = document.referrer;';
              
              if(isset($_POST['idE']) && $_POST['idE'] != null){
                echo 'const idEInput = document.createElement("input");
                idEInput.type = "hidden";
                idEInput.name = "idE";
                idEInput.value = ' . json_encode($_POST['idE']) . ';
                form.appendChild(idEInput);';
              }

              if(isset($_POST['boutonaj']) && $_POST['boutonaj'] != null){
                echo 'const idEInput = document.createElement("input");
                idEInput.type = "hidden";
                idEInput.name = "boutonaj";
                idEInput.value = ' . json_encode($_POST['boutonaj']) . ';
                form.appendChild(idEInput);';
              }
              
              echo 'document.body.appendChild(form);
              form.submit();
          </script>';
          return;
        } else {
         // on redirige avec la méthode get
         return redirect()->back();
        }
   }

}