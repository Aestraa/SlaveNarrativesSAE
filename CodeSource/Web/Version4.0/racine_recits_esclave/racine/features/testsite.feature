Feature: Website URL Check
  In order to verify that my website is accessible
  As a user
  I need to be able to access the website URL

  Scenario: Check if the website URL is accessible
    Given I am on the website "https://slavenarrativessae.000webhostapp.com"
    Then I should see the website loaded successfully

  Scenario: Switching the website language
    Given I am on any page of the website
    When I click on the 'EN' button
    Then the website should be in English
    When I click on the 'FR' button
    Then the website should be in French
