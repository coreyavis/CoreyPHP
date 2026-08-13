# CoreyPHP

The CoreyPHP class is the foundational base class for the entire CoreyPHP framework ecosystem. This class encapsulates essential, high-frequency PHP utility methods, ensuring a unified, streamlines, and efficient development workflow across the application.

## Table of Contents

1. [Usage](#usage)
2. [Parameters](#parameters)
3. [System Methods](#system-methods)
    - [Config Methods](#config-methods)
    - [Error Handling](#error-handling)
4. [Public Methods](#public-methods)
    - [Color Code](#color-code)
    - [Conversion](#conversion)
    - [Cookie Management](#cookie-management)
    - [Formatting](#formatting)
    - [IP Operations](#ip-operations)
    - [Session Management](#session-management)
    - [Validation](#validation)
5. [Internal Methods](#internal-methods)
    - [Helpers](#helpers)
6. [Public Properties](#public-properties)
7. [Configuration Options](#configuration-options)
    
## Usage

```
$cphp = new CoreyPHP(array $userConfig);
```

## Parameters

**userConfig**
: An array of initial configuration options; alternatively, use setConfig() to update these values later.

## System Methods

### Config Methods

The following methods are used to read and set configuration options.

- [getConfig](CoreyPHP/getConfig.md)
- [setConfig](CoreyPHP/setConfig.md)

### Error Handling

The following methods handle errors.

- [error](CoreyPHP/error.md) - Error handler
- [errorMsg](CoreyPHP/errorMsg.md) - Error message
- [exceptionMsg](CoreyPHP/exceptionMsg.md) - Exception message

## Public Methods

### Color Code

The following methods are part of the [CoreyPHP Color Code Utility System](ColorCodes.md), used to convert color codes between keys, names, hex strings, and RGB arrays.

- [codeToColor](CoreyPHP/codeToColor.md) - Converts a character code tomits human-readable color name
- [codeToHex](CoreyPHP/codeToHex.md) - Converts a character code to a CSS-compatible hexadecimal string
- [codeToRgb](CoreyPHP/codeToRgb.md) - Converts a character code to an RGB integer array
- [colorToCode](CoreyPHP/colorToCode.md) - Converts a human-readable color name back into a character code

### Conversion

The following methods facilitate format conversion and serialization, allowing for seamless transformation between data structures.

- [arrayToJson](CoreyPHP/arrayToJson.md) - Array to JSON conversion
- [arrayToObject](CoreyPHP/arrayToObject.md) - Array to Object conversion
- [arrayToSerial](CoreyPHP/arrayToSerial.md) - Array to Serialized string conversion
- [jsonToArray](CoreyPHP/jsonToArray.md) - JSON to Array conversion
- [jsonToObject](CoreyPHP/jsonToObject.md) - JSON to Object conversion
- [jsonToSerial](CoreyPHP/jsonToSerial.md) - JSON to Serialized string conversion
- [objectToArray](CoreyPHP/objectToArray.md) - Object to Array conversion
- [objectToJson](CoreyPHP/objectToJson.md) - Object to JSON conversion
- [objectToSerial](CoreyPHP/objectToSerial.md) - Object to Serialized string conversion
- [serialToArray](CoreyPHP/serialToArray.md) - Serialized string to Array conversion
- [serialToJson](CoreyPHP/serialToJson.md) - Serialized string to JSON conversion
- [serialToObject](CoreyPHP/serialToObject.md) - Serialized string to Object conversion

### Cookie Management

The following methods provide secure, developer-friendly interfaces for reading, writing, and removing HTTP cookies.

- [getCookie](CoreyPHP/getCookie.md) - Retrieves cookie data
- [removeCookie](CoreyPHP/removeCookie.md) - Deletes a cookie
- [setCookie](CoreyPHP/setCookie.md) - Sets an HTTP cookie

### Formatting

The following methods are used to format data.

- [decimals](CoreyPHP/decimals.md) - Formats decimals

### IP Operations

The following methods retrieve, format-check, and categorize an IP address to make sure it's safe and ready to use.

- [getIP](CoreyPHP/getIP.md) - Get IP address
- [reservedIP](CoreyPHP/reservedIP.md) - Validate if reserved IP address
- [validIP](CoreyPHP/validIP.md) - Validate IP address

### Session Management

The following methods provide a wrapper around PHP's native session handling.

- [clearSession](CoreyPHP/clearSession.md) - Clears all session variables without destroying the session ID or cookie
- [endSession](CoreyPHP/endSession.md) - Destroys the current session, unsets memory data, and deletes the session cookie
- [getSession](CoreyPHP/getSession.md) - Retrieves a specific session value or the entire session array
- [regenSession](CoreyPHP/regenSession.md) - Regenerates the current session ID to prevent session fixation
- [removeSession](CoreyPHP/removeSession.md) - Removes a specific variable from the session
- [setSession](CoreyPHP/setSession.md) - Sanitizes and stores a key-value pair in the active session
- [startSession](CoreyPHP/startSession.md) - Initializes or resumes an active PHP session with secure cookie defaults

### Validation

The following methods validate data formats and types.

- [isAssoc](CoreyPHP/isAssoc.md) - Validate associative arrays
- [isJson](CoreyPHP/isJson.md) - Validates if string is JSON
- [isSerial](CoreyPHP/isSerial.md) - Validate serialized value

## Internal Methods

The following methods are either **private** or **protected**. They are documented here for developers who wish to extend this class.

### Helpers

- [autoDetectDomain](CoreyPHP/autoDetectDomain.md) - Detects server hostname
- [escape](CoreyPHP/escape.md) - Encode special characters
- [isHttps](CoreyPHP/isHttps.md) - Detects secure connection
- [resolveDomain](CoreyPHP/resolveDomain.md) - Resolves active domain
- [sanitizeData](CoreyPHP/sanitizeData.md) - Sanitize array keys and values
- [sanitizeValue](CoreyPHP/sanitizeValue.md) - Sanitize scalar values

## Public Properties

| Variable | Description | Example |
| --- | --- | --- |
| sessionId | The read-only session ID. | `$cphp->sessionId` |

## Configuration Options

Refer to the [Configuration Documentation](Config.md#coreyphp) section for a complete overview.

---
[Home](Home.md) | CoreyPHP
