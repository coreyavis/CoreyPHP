# CoreyPHP Documentation

This documentation will help give you a better understanding of how each class and method within the CoreyPHP class library works.

## Table of Contents

1. [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Usage](#usage)
    - [Methods](#methods)
2. [Documentation by Class](#documentation-by-class)

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
3. Use the methods in each class as outlined in this documentation.
```
$obj->method();
$obj->method($parameter);
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
3. Use the methods in the class as outlined in this documentation.
```
$db->method();
$db->method($parameter);
```

### Methods

> Within the class files, each method is documented with its parameters and return type.

#### Class Methods

"**Class methods**" are the functions defined within a class. These methods can accept zero, one, or multiple *parameters* (arguments), some of which may be <u>optional</u>.

A method's *return value* is entirely dependent on its task. While some methods return strings, integers, or arrays others return a boolean (==true== or ==false==). A ==true== return typically indicates the method executed successfully, while ==false== indicates failure. If a method returns ==$this==, it returns the class object itself, enabling **method chaining** to string multiple operations together.

#### Method Chaining

There is no limit to how many methods can be chained together but once a method returns a value of some kind like a *string*, *integer*, *array* or *boolean* the chain ends.

Example:
```
$obj->method->()method();
```

#### Returned Value

Once a value has been returned you can either assign it to a variable for use later or display it on your page.

```
$var = $obj->method();
echo $obj->method();
```

> If a method returns an array, you must first assign it to a variable for further processing, as the ==echo== statement cannot directly output complex data types. Use functions like ==print_r()== to display the array's contents or iterate over it using a loop to properly display or manipulate the data.

## Documentation by Class

- CoreyPHP
- CoreyDB: Database Management
- CoreyFile: File Management
- CoreyForm: Form Builder
- [CoreyFX](FX/FX.md): Formulas and Equations
- CoreyHTML: HTML Generator
- CoreySecurity: Security Class
- CoreySession: Session Management
- CoreyTable: Table Builder
