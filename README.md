# CoreyPHP

A PHP Class Library aimed at making front-end and back-end development easier, along with being a PHP learning tool.

## Table of Contents

1. [Getting Started](#getting-started)
2. [Documentation](#documentation)
3. [License](#license)

## Getting Started

### Prerequisites

**Required**: PHP version 5.3.0 or above

Recommended: PHP version 7.0.0 or above

*MySQLi is currently the only supported database extension used in this script and it must be installed if you plan on using CoreyDB.php.*

> It is recommended to have a good general understanding of PHP coding.

### Usage

First, you need to include the file you intend to use in your php script with the php include or require functions.

```
include_once('/src/CoreyPHP.php');
require_once('/src/CoreyDB.php');
```

Second, you need to create an instance of the class object. Name the variable to store your object in anything you'd like.

```
$corey = new CoreyPHP();
$obj = new CoreyDB();
```

Third, use the included class object functions as outlined in the [documentation](docs/Home.md).

## Documentation

For full documentation see [here](docs/Home.md)

## License

CoreyPHP is licensed under the [GNU General Public License v3.0](LICENSE)

![GitHub License](https://img.shields.io/github/license/coreyavis/CoreyPHP)
