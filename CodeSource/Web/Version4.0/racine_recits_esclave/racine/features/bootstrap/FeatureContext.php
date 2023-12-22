<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am on the website :url
     */
    public function iAmOnTheWebsite($url)
    {
        $this->visit($url);
    }

    /**
     * @Then I should see the website loaded successfully
     */
    public function iShouldSeeTheWebsiteLoadedSuccessfully()
    {
        $statusCode = $this->getSession()->getStatusCode();
        if ($statusCode != 200) {
            throw new Exception("Website did not load successfully. Status code: $statusCode");
        }
    }

    /**
     * @Given I am on any page of the website
     */
    public function iAmOnAnyPageOfTheWebsite()
    {
        // Vous pouvez visiter la page d'accueil ou une autre page
        $this->visit('/');
    }

    /**
     * @When I click on the :language button
     */
    public function iClickOnTheLanguageButton($language)
    {
        // Utilisez l'ID du lien pour cliquer dessus
        $linkId = 'changeLanguageEN';
        $link = $this->getSession()->getPage()->find('css', "a[id='$linkId']");

        if (null === $link) {
            throw new Exception("Language switch button not found: " . $linkId);
        }

        // Imprimer le nom de la classe de l'élément cliqué
        $class = $link->getAttribute('class');
        print_r("The class of the clicked link is: " . $class . "\n");

        // Cliquer sur le lien
        $link->click();

        // Attendre que la page se recharge et que le contenu soit mis à jour
        // Note : Sleep est utilisé ici pour simplicité, mais il est préférable d'utiliser une méthode d'attente explicite
        sleep(3);

        // Trouver la balise h1 et imprimer son contenu
        $h1 = $this->getSession()->getPage()->find('css', 'h1');

        if ($h1) {
            $h1Text = $h1->getText();
            print_r("The text of the h1 element is: " . $h1Text . "\n");
        } else {
            print_r("No h1 element found on the page.\n");
        }
    }




    /**
     * @Then the website should be in English
     */
    public function theWebsiteShouldBeInEnglish()
    {
        // Vérifiez que le bouton 'FR' est maintenant actif
        sleep(3);
        // Vérifiez que le titre de la page est 'Slave narratives'
        $this->assertPageContainsText('Slave narratives');
    }

    /**
     * @Then the website should be in French
     */
    public function theWebsiteShouldBeInFrench()
    {
        // Vérifiez que le bouton 'EN' est maintenant actif
        sleep(3);
        // Vérifiez que le titre de la page est 'Récits d'esclaves'
        $this->assertPageContainsText('Récits d\'esclaves');
    }
}
