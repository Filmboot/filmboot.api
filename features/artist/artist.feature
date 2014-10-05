@artist
Feature: Artist API
  In order to manage artist info
  As a developer
  I want to create, read, update and delete artist info

  Background:
    Given the following artists exist:
      | firstName | lastName | birthday   | birthplace | biographyEs                  | biographyEn                  | website             |
      | Santiago  | Segura   | 1965-07-19 | 3038816    | BiographyEs Santiago Segura  | BiographyEn Santiago Segura  |                     |
      | Armando   | De Razza | 1955-05-23 | 3038816    | BiographyEs Armando De Razza | BiographyEn Armando de Razza | armandodereazza.com |
      | Stanley   | Weiser   | 1959-03-14 | 3038816    | BiographyEs Stanley Weiser   | BiographyEn Stanley Weiser   | stanleyweiser.com   |

  Scenario: Seeing all artists
    When I send a GET request to "/artists"
    Then the response code should be 200
    And the response should contain "Santiago"
    And the response should contain "Armando"
    And the response should contain "Stanley"

  Scenario: Filtering artists by name
    When I send a GET request to "/artists?q=Santiago"
    Then the response code should be 200
    And the response should contain "Santiago"
    And the response should not contain "Armando"
