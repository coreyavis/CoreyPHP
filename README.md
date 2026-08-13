# CoreyPHP

Streamline your PHP development and accelerate your journey with this dual-purpose class library ecosystem. Built on a shared core architecture, you can integrate individual libraries standalone to speed up coding, or seamlessly link them together into a cross-communicating data pipeline. It's the power of simplicity for both seasoned developers and those learning PHP.

## Table of Contents

1. [Getting Started](#getting-started)
2. [Classes](#classes)
2. [Documentation](#documentation)
3. [License](#license)

## Getting Started

### Prerequisites

- **Required**: PHP version 8.4 or above
- **Core Dependancy**: The `CoreyPHP.php` base class file must always be present in your `src/` folder, as all other libraries extend from it.
- **Database**: MySQLi is required if you plan on using the database component (`CoreyDB`).

> It is recommended to have a good general understanding of Object-Oriented PHP coding.

### Usage

1. Include the `autoload.php` file at the top of the page where you intend to use the libraries. It is highly recommended to use the `require_once()` php function.

```
require_once('autoload.php');
```

2. Create an instance of the specific sub-library class object you intend to use. You do not need to manually initialize the base `CoreyPHP` class first; the sub-libraries will automatically initialize it in the background.

```
$db = new CoreyDB();
$fx = new CoreyFX();
```

3. Call the methods directly. Any core utility methods (like `getIP()` or `arrayToJson()`) are inherited automatically and can be executed straight from the sub-library object:

```
$db->method();
```

## Classes

All libraries inherit global configuration parsing, custom error tracking, and core utility methods directly from the core file:

- CoreyPHP: Core Foundation, Global Settings, and Utility Base Class
- CoreyDB: Database Management & Query Building
- CoreyFile: File System Management
- CoreyForm: Form Builder
- CoreyFX: Formulas and Equations
- CoreyTable: Table Builder

## Documentation

For full documentation see [here](docs/Home.md)

## License

CoreyPHP is licensed under the [GNU General Public License v3.0](LICENSE)

![GitHub License](https://img.shields.io/github/license/coreyavis/CoreyPHP)
