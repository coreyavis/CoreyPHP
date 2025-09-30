# CoreyPHP

A PHP Class Library aimed at making front-end and back-end development easier, along with being a PHP learning tool.

## Table of Contents

1. [Getting Started](#getting-started)
2. [Documentation](#documentation)
3. [License](#license)

## Getting Started

### Prerequisites

It is recommended to have a good general understanding of PHP coding.

Required: PHP version 5.3.0 or above [^1]

[^1]: The MySQLi extension was added to PHP 5.0.0

Recommended: PHP version 7.0.0 or above [^2]

[^2]: The MySQL extension was removed in PHP 7.0.0

MySQLi is currently the only supported database extension used in this script and it must be installed if you plan on using CoreyDB.php.

Java is a recommended program to install to use some included scripts but is not required.

### Usage

First, you need to include the file you intend to use in your php script with the php include or require functions. [^3]

[^3]: The include function will throw a warning if the file doesn't exist and the require function will throw a fatal error if the file doesn't exist.

```
include_once('/src/CoreyPHP.php');
require_once('/src/CoreyDB.php');
```

Second, you need to create an instance of the class object. [^4]

[^4]: The variable you store the class object in can be named however you'd like.

```
$corey = new CoreyPHP();
$obj = new CoreyDB();
```

Third, use the included class object functions as documented in the [documentation](https://github.com/coreyavis/CoreyPHP/wiki).

## Documentation

For full documentation see [here](https://github.com/coreyavis/CoreyPHP/wiki)

## License

CoreyPHP is licensed under the [GNU General Public License v3.0](LICENSE)

![GitHub License](https://img.shields.io/github/license/coreyavis/CoreyPHP)
