# CoreyPHP Documentation

This documentation will help give you a better understanding of how each class and function within the CoreyPHP class library works.

## Table of Contents

1. [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Usage](#usage)
2. [Documentation by Class](#classes)

## Getting Started

### Prerequisites

**Required**: PHP version 5.3.0 or above

Recommended: PHP version 7.0.0 or above

*MySQLi or PDO if you plan on using a database.*

> It is recommended to have a good general understanding of PHP coding.

### Usage

There are two ways you can use the classes.

Option 1: (**Recommended**)

1. Include the "autoload.php" file at the top of the page where you intend to use the library. I recommend using the require_once() php function.
```
require_once('autoload.php');
```
2. Create an instance of the class object you intend to use.
```
$obj = new CoreyPHP();
$db = new CoreyDB();
```
3. Use the functions in each class as outlined in this documentation.
```
$obj->function();
$obj->function($variables);
```

---

Option 2:

1. Include the class file you intend to use at the top of the page.
```
require_once('src/CoreyDB.php');
```
2. Create an instance of the class object.
```
$db = new CoreyDB();
```
3. Use the functions in the class as outlined in this documentation.
```
$db->select();
```

## Classes

- CoreyPHP
- CoreyDB: Database Management
- CoreyFile: File Management
- CoreyForm: Form Builder
- [CoreyFX](FX.md): Formulas and Equations
- CoreyHTML: HTML Generator
- CoreySecurity: Security Class
- CoreySession: Session Management
- CoreyTable: Table Builder
