# Corey Security Suite

The CoreySecurity class is a robust, zero-dependency cryptographic and identity toolkit designed for modern PHP applications. Rather than scattering security logic across multiple helpers, this class unifies secure generation, safe hashing, and password analysis into a single, cohesive engine.

## Table of Contents

1. [Usage](#usage)
2. [Parameters](#parameters)
3. [Public Methods](#public-methods)
    - [Config](#config)
    - [Structure](#structure)
    - [Generators](#generators)
    - [Hashing](#hashing)
    - [Metrics](#metrics)
4. [Internal Methods](#internal-methods)
    - [Inspectors](#inspectors)
    - [Helpers](#helpers)
5. [Public Properties](#public-properties)
6. [Configuration Options](#configuration-options)
    
## Usage

```
$sec = new CoreySecurity(array $userConfig);
```

## Parameters

**userConfig**
: An array of initial configuration options; alternatively, use setConfig() to update these values later.

## Public Methods

### Config

The following methods are used to set configuration options.

- [loadCustomBlacklist](CoreySecurity/loadCustomBlacklist.md) - Add words to the leet-speak blacklist

### Structure

The following methods manage global configuration states.

- [getAlgorithm](CoreySecurity/getAlgorithm.md) - Retrieves active hashing algorithm
- [listAlgorithms](CoreySecurity/listAlgorithms.md) - List available hashing algorithms
- [setAlgorithm](CoreySecurity/setAlgorithm.md) - Sets the active hashing algorithm

### Generators

The following methods generate secure, highly complex, unpredictable, high-entropy raw data.

- [credentialGen](CoreySecurity/credentialGen.md) - Generates credentials including password, salt, hashed(salt + password), and algorithm used
- [idGen](CoreySecurity/idGen.md) - ID generator
- [passGen](CoreySecurity/passGen.md) - Generates a secure password
- [saltGen](CoreySecurity/saltGen.md) - Generates a secure salt string

### Hashing

The following methods handle the secure storage and verification of sensitive data.

- [hash](CoreySecurity/hash.md) - Generates a hash of a single string value
- [passHash](CoreySecurity/passHash.md) - Creates a password hash by combining a password with a salt

### Metrics

The following methods provide analytical intelligence, evaluating the quality of input data.

- [passEntropy](CoreySecurity/passEntropy.md) - Calculates the entropy of a given password
- [passStrength](CoreySecurity/passStrength.md) - Evaluates the security strength of a given password

## Internal Methods

The following methods are either **private** or **protected**. They are documented here for developers who wish to extend this class.

### Inspectors

- [algorithmExists](CoreySecurity/algorithmExists.md) - Verify hashing algorithm
- [passCheck](CoreySecurity/passCheck.md) - Evaluates a generated password

### Helpers

- [errorHash](CoreySecurity/errorHash.md) - Generates random `error_` hex string
- [getSymbols](CoreySecurity/getSymbols.md) - Returns password generation symbols list
- [passCodeMsg](CoreySecurity/passCodeMsg.md) - Descriptive message for password attribute score
- [scoreStrength](CoreySecurity/scoreStrength.md) - Format a score
- [validatePool](CoreySecurity/validatePool.md) - Validates password character pool

## Public Properties

| Variable | Description | Example |
| --- | --- | --- |
| algo | The currently selected hashing algorithm. | `$sec->algo` |

## Configuration Options

Refer to the [Configuration Documentation](Config.md#coreysecurity) section for a complete overview.

---
[Home](Home.md) | CoreySecurity
