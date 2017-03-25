# Travel Cart


Build the container:

```sh
docker build -t davidino/travel .
```

Run test container:

```sh
docker run davidino/travel
```

the output:
```
Feature: test

  Scenario:                        
    Given the basket has:          
      | qty | name   |
      | 1   | bread  |
      | 1   | butter |
      | 1   | milk   |
    When I total the basket        
    Then the total should be £2.95 

  Scenario:                        
    Given the basket has:          
      | qty | name   |
      | 2   | bread  |
      | 2   | butter |
    When I total the basket        
    Then the total should be £3.10 

  Scenario:                        
    Given the basket has:          
      | qty | name |
      | 4   | milk |
    When I total the basket        
    Then the total should be £3.45 

  Scenario:                       
    Given the basket has:         
      | qty | name   |
      | 1   | bread  |
      | 2   | butter |
      | 8   | milk   |
    When I total the basket       
    Then the total should be £9.0 

4 scenarios (4 passed)
12 steps (12 passed)
0m0.02s (7.66Mb)
```


```sh
docker run davidino/travel bin/phpunit
```