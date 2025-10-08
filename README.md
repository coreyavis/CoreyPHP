# CoreyPHP

Streamline your PHP development and accelerate your journey with this dual-purpose class library. Designed to simplify common front-end and back-end tasks, you can use its robust set of functions as standalone tools to speed up coding, or integrate the full library to kickstart your next website project. It's the power of simplicity for both seasoned developers and those learning PHP.

## Table of Contents

1. [Getting Started](#getting-started)
2. [Classes](#classes)
2. [Documentation](#documentation)
3. [License](#license)

## Getting Started

### Prerequisites

**Required**: PHP version 5.3.0 or above

Recommended: PHP version 7.0.0 or above

*MySQLi or PDO if you plan on using a database.*

> It is recommended to have a good general understanding of PHP coding.

### Usage

1. Include the "autoload.php" file at the top of the page where you intend to use the library. I recommend using the require_once() php function.
```
require_once('autoload.php');
```
2. Create an instance of the class object you intend to use.
```
$obj = new CoreyPHP();
$db = new CoreyDB();
```
3. Use the methods in each class as outlined in the documentation.
```
$obj->method();
```

### Classes

- CoreyPHP
- CoreyDB: Database Management
- CoreyFile: File Management
- CoreyForm: Form Builder
- CoreyFX: Formulas and Equations
- CoreyHTML: HTML Generator
- CoreySecurity: Security Class
- CoreySession: Session Management
- CoreyTable: Table Builder

## Documentation

For full documentation see [here](docs/Home.md)

## License

CoreyPHP is licensed under the [GNU General Public License v3.0](LICENSE)

![GitHub License](https://img.shields.io/github/license/coreyavis/CoreyPHP)
