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
        // Utilisez l'ID du bouton pour cliquer dessus
        $buttonId = $language == 'EN' ? 'changeLanguageEN' : 'changeLanguageFR';
        $button = $this->getSession()->getPage()->find('css', "a[id='$buttonId']");
        if (null === $button) {
            throw new Exception("Button not found: " . $buttonId);
        }
        $button->click();
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