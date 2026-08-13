# Configuration Documentation

This lists all configuration options for the CoreyPHP class, organized into global and class-specific values.

## Table of Contents

1. [Config Methods](#config-methods)
2. [Global Config](#global-config)
3. [Class Config](#class-config)
    - [CoreyPHP](#coreyphp)
    - [CoreyDB](#coreydb)
    - [CoreyFile](#coreyfile)
    - [CoreyForm](#coreyform)
    - [CoreyFX](#coreyfx)
    - [CoreySecurity](#coreysecurity)
    - [CoreyTable](#coreytable)
4. [Developer Config](#developer-config)

## Config Methods

These methods are used to read and set configuration options.

- [getConfig](CoreyPHP/getConfig.md)
- [setConfig](CoreyPHP/setConfig.md)

## Global Config

These configuration options are global across all classes.

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| debug | false | *bool* | Debug mode - Helps by giving more information about errors. |
| override | false | *bool* | Can override certain default minimums or maximums within config. |
| **Warning**: Don't use `override` unless you know what you're doing. ||||

## Class Config

These configuration options are unique to its class.

### CoreyPHP

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| cookie.lifetime.months | 0 | *integer* &ge; 0 | Retention months (calculated as 30 days per month). |
| cookie.lifetime.weeks | 0 | *integer* &ge; 0 | Retention weeks (calculated as 7 days per week). |
| cookie.lifetime.days | 30 | *integer* &ge; 0 | Retention days. |
| cookie.lifetime.hours | 0 | *integer* &ge; 0 | Retention hours. |
| cookie.lifetime.minutes | 0 | *integer* &ge; 0 | Retention minutes. |
| domain | '' (empty) | *string* | Domain name of website. If left empty the script will attempt to get the domain. |
| dp | 2 | *integer* | Decimal points |
| session.auto | true | *bool* | Initialize sessions. |
| session\.id | '' (empty) | *string* | Default session ID. If left empty, a random session ID will be created. |
| **Note**: Random session ID's is recommended. Only supply if you have a good reason. ||||
| session\.name | COREYSESSID | *string* | Default session name. Only change if you plan on creating more than one session. |

### CoreyDB

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| blacklist | ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'] | *array* | Databases to ignore |
| charset | utf8mb4 | *string* | The database character set to use. |
| db.host | localhost | *string* | Database host name |
| db\.name | null | *string* | Database name |
| db.pass | root | *string* | Database password |
| db.user | root | *string* | Database username |
| engine | InnoDB | *string* | The database engine to use when creating new databases. |
| glue | ' ' (space) | *string* | The separator used for string concatenation. |
| output | auto | *string* (See: [Output](CoreyDB/output.md)) | Default output data type. |

### CoreyFile

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |

### CoreyForm

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |

### CoreyFX

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| abbr | false | *bool* | Abbreviates certain words like hours to hrs. |
| dp | 2 | *integer* | Decimal points |

### CoreySecurity

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| algorithm | sha256 | *string* | Default hashing algorithm. |
| exclude.similar | false | *bool* | Exclude similar characters from password generation (`0`, `O`, `o`, `1`, `l`, `I`). |
| exclusion | '' (empty) | *string* | Letters, numbers, or symbols you would like to exclude from password generation as string. |
| minLength | 8 | *integer* | Minimum password length. |
| numbers | true | *bool* | Allow numbers in password generation. |
| symbols | true | *bool* | Allow symbols in password generation. |
| uppercase | true | *bool* | Allow uppercase letters in password generation. |

### CoreyTable

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
|  |  |  |  |
|  |  |  |  |
|  |  |  |  |

## Developer Config

When debug mode is enabled via the configuration, `setConfig('debug', true)`, errors are displayed with a stack trace as well as triggered or logged.

> The `debug` configuration option should be false for live sites.

---
[Home](Home.md) | Configuration
