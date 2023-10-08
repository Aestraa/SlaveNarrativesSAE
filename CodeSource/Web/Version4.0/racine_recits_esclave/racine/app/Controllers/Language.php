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

        if(isset($_POST['idE']) && $_POST['idE'] != null){
              //on redirige avec la méthode post
              echo '<body><script>
              const form = document.createElement("form");
              form.method = "post";
              form.action = document.referrer;  // Rediriger vers la page précédente
              
              const idEInput = document.createElement("input");
              idEInput.type = "hidden";
              idEInput.name = "idE";
              idEInput.value = ' . json_encode($_POST['idE']) . ';  // Insérer la valeur de idE
              form.appendChild(idEInput);
              
              document.body.appendChild(form);
              form.submit();
          </script>';
          return;
        } else {
         // on redirige avec la méthode get
         return redirect()->back();
        }
   }

}