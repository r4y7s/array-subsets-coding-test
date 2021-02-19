# Algorithm that generates all the subsets of size k

## Test

Given a set of integer S of size n and an integer constant k such as 0<=k. 
Write an algorithm that generates and prints on the console all the subsets of size k that can be obtained from the elements on S.

Example:

**S: {1,2,3,4}**

- If k == 0 then { {} }
- if k == 1 then { {1}, {2}, {3}, {4} }
- if k == 2 then { {1,2}, {1,3}, {1,4}, {2,3}, {2,4}, {3,4} }
- if k == 3 then { {1,2,3}, {1,3,4},{1,2,4}, {2,3,4} }
- if k == 4 then { {1,2,3,4} }
- if k > 4 then {}


## How run
- php-cli
  - php bin/console subsets
- phpunit:
    - composer test
    - vendor/bin/phpunit
