# CoreyPHP Documentation

This documentation will help give you a better understanding of how each class, inheritance structure, and pipeline method within the CoreyPHP class library ecosystem works.

## Table of Contents

1. [Classes](#classes)
2. [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
3. [Usage](#usage)
    - [Methods](#methods)
        - [Class Methods](#class-methods)
        - [Inherited Core Methods](#inherited-core-methods)
        - [Method Chaining & Pipelines](#method-chaining-and-pipelines)
        - [Returned Value](#returned-value)
    - [Configuration](#configuration)
        - [Configuration Options](#configuration-options)
    - [Error Handling](#error-handling)

## Classes

- [CoreyPHP](CoreyPHP.md): Core Foundation, Global Settings, and Utility Base Class
- [CoreyDB](CoreyDB.md): Database Management & Query Building
- [CoreyFile](CoreyFile.md): File System Management
- [CoreyFX](CoreyFX.md): Formulas and Equations
- [CoreySecurity](CoreySecurity.md): Security Suite

## Getting Started

### Prerequisites

- **Required**: PHP version 8.4 or above
- **Core Dependancy**: The `CoreyPHP.php` base class file must always be present in your `src/` folder, as all other libraries extend from it.
- **Database**: MySQLi is required if you plan on using the database component (`CoreyDB`).

> It is recommended to have a good general understanding of Object-Oriented PHP coding.

## Usage

There are two clean ways you can load and interact with the ecosystem:

Option 1: Using the Autoloader (**Recommended**)

1. Include the `autoload.php` file at the top of the page where you intend to use the libraries. It is highly recommended to use the `require_once()` php function.

```
require_once('autoload.php');
```

2. Create an instance of the specific sub-library class object you intend to use. You do not need to manually initialize the base `CoreyPHP` class first; the sub-libraries will automatically initialize it in the background.

```
$db = new CoreyDB();
$fx = new CoreyFX();
```

Option 2: Standalone Manual Includes

If you are not using the autoloader, you must explicitly require the master `CoreyPHP.php` base class before including any sub-library that extends it:

```
require_once('src/CoreyPHP.php'); // Required first!
require_once('src/CoreyDB.php');

$db = new CoreyDB();
```

### Methods

Within the class files, each method is documented with its parameters and return type.

#### Class Methods

"**Class methods**" are the functions defined within a class. These methods can accept zero, one, or multiple parameters (arguments), some of which may be optional.

```
$db->method($var);
```

A method's *return value* is entirely dependent on its task. While some methods return strings, integers, or arrays others return a boolean (`true` or `false`). A `true` return typically indicates the method executed successfully, while `false` indicates failure. If a method returns `$this`, it returns the class object itself, enabling **method chaining** to string multiple operations together.

#### Method Signatures and Type Safety

CoreyPHP utilizes PHP's type hinting system to ensure data integrity and make the library easier to debug. Each method signature defines what data it expects and what it will return.

```
public function method(array|string|int|float|null $key = null, mixed $value = null): bool
```

#### Inherited Core Methods

Because every library in the ecosystem extends `CoreyPHP`, global helper methods like `getIP()` and `arrayToJson()` are inherited automatically. You call them using the exact same arrow syntax directly from the sub-library instance:

```
$db = new CoreyDB();
$jsonString = $db->arrayToJson($array);
```

#### Method Chaining and Pipelines

If a method returns `$this`, it returns the class object itself, enabling method chaining:

```
$db->select()->where()->execute();
```

> There is no limit to how many methods can be chained together but once a method returns a value of some kind like a array, string, integer, float or boolean the chain ends.

Example:
```
$cphp->method()->method()->method()->method()->method();
```

#### Returned Value

Once a value has been returned, you can assign it to a variable or display it directly.

```
$var = $db->method();
echo $db->method();
```

> When a method returns an array, you must first assign it to a variable for further processing, as the `echo` statement cannot directly output complex data types. Use functions like `print_r()` to display the array's contents or iterate over it using a loop to properly display or manipulate the data.

### Configuration

Every sub-library automatically inherits the centralized dot-notation configuration engine. When you instantiate a child class, its local default configuration arrays are safely merged with the parent settings at runtime.

You can set parameters via the constructor or dynamically using the inherited `setConfig()` method:

```
// Set via instantiation array mapping.
$db = new CoreyDB(['int' => 5, 'bool' => true]);

// Set dynamically later
$db->setConfig('key', 'value');
```

#### Configuration Options

You have two ways to see the [configuration options](Config.md):

1. Check the documentation: Refer to the [Configuration Documentation](Config.md) section for a complete overview.
2. Use the method: Call the `getConfig()` method in each class to return the current configuration options as an array.

### Error Handling

Because all libraries inherit from `CoreyPHP`, the very first class you initialize automatically registers the custom global error handlers, wrapping the entire ecosystem in a unified error tracking framework.

- See the documentation: Refer to the [Error Handling Documentation](ErrorHandling.md) section for a complete overview.

---
Home
