@address_book
Feature: Viewing my address book
    In order to see all my addresses
    As a Customer
    I want to be able to browse my address book

    Background:
        Given the store operates on a single channel in "United States"
        And I am a logged in customer

    @ui
    Scenario: Viewing all addresses
        Given I have an address "Lucifer Morningstar", "Seaside Fwy", "90802", "Los Angeles", "United States", "Arkansas" in my address book
        When I browse my address book
        Then I should see a single address in my book

    @ui
    Scenario: Seeing only my addresses
        Given there is a customer "John Doe" identified by an email "doe@example.com" and a password "banana"
        And this customer has an address "John Doe", "Banana Street", "90232", "New York", "United States", "Kansas" in their address book
        And I have an address "Lucifer Morningstar", "Seaside Fwy", "90802", "Los Angeles", "United States", "Arkansas" in my address book
        When I browse my address book
        Then I should see a single address in my book
        And this address should be assigned to "Lucifer Morningstar"
        And I should not see the address assigned to "John Doe"

    @ui
    Scenario: Viewing empty address book
        When I browse my address book
        Then there should be no addresses
