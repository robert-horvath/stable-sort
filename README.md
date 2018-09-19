[![Build Status](https://travis-ci.org/robert-horvath/stable-sort.svg?branch=master)](https://travis-ci.org/robert-horvath/stable-sort)
[![Code Coverage](https://codecov.io/gh/robert-horvath/stable-sort/branch/master/graph/badge.svg)](https://codecov.io/gh/robert-horvath/stable-sort)
[![Latest Stable Version](https://img.shields.io/packagist/v/robert/stable-sort.svg)](https://packagist.org/packages/robert/stable-sort)

## Definition
[Wikipedia](https://en.wikipedia.org/wiki/Category:Stable_sorts): Stable sorting algorithms maintain the relative order of records with equal keys (i.e. values). That is, a sorting algorithm is stable if whenever there are two records R and S with the same key and with R appearing before S in the original list, R will appear before S in the sorted list. 

## Problem
PHP sorting algorithms do not guarantee relative order if two members are equal.

From [php.net](http://php.net/manual/en/array.sorting.php): **If any of these sort functions evaluates two members as equal then the order is undefined (the sorting is not stable).**

## Notes
This module's sorting algorithm do not return a ```bool``` value. 

From [stackoverflow.com](https://stackoverflow.com/questions/5354891/why-would-sort-fail): PHP's sort function only returns false, if *zend_hash_sort* fails. *zend_hash_sort* is a macro, which actually calls *zend_hash_sort_ex*. This function was build pretty robust and returns SUCCESS in all cases - even if you pass arrays with totally uncompareable elements.

The PHP [sort function](https://github.com/php/php-src/blob/master/ext/standard/array.c#L913) does some parameter checking with macros and has three rules. 
* The function takes at least one argument and max 2 arguments.
* The first argument must be an array
* The second argument (if given) must be a long

It is *not possible* to break any of the above rules with this module. Therefore, the return value is removed. (i.e.: ```void```)
 
## Example Usage  
```php
$arr = [
  'y' => '3',
  'z' => '9',
  'b' => '1',
  'k' => '2',
  'a' => '1',
  'x' => '3'
];
RHo\StableSort\StableSort::uasort($arr, 'strcmp');
var_dump($arr);
```
This will output

```
array(6) {
  'b' =>
  string(1) "1"
  'a' =>
  string(1) "1"
  'k' =>
  string(1) "2"
  'y' =>
  string(1) "3"
  'x' =>
  string(1) "3"
  'z' =>
  string(1) "9"
}
```
