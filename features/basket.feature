Feature: customer basket that allows a customer to
         add products and provides a total cost of the basket
         including applicable discounts.

  Scenario:
    Given the basket has:
      | qty  | name   |
      | 1    | bread  |
      | 1    | butter |
      | 1    | milk   |
    When I total the basket
    Then the total should be £2.95

  Scenario:
    Given the basket has:
      | qty  | name   |
      | 2    | bread  |
      | 2    | butter |
    When I total the basket
    Then the total should be £3.10

  Scenario:
    Given the basket has:
      | qty  | name   |
      | 4    | milk   |
    When I total the basket
    Then the total should be £3.45

  Scenario:
    Given the basket has:
      | qty  | name   |
      | 1    | bread  |
      | 2    | butter |
      | 8    | milk   |
    When I total the basket
    Then the total should be £9.0
