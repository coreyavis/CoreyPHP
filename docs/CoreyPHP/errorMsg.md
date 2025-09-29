# errorMsg

Explicitly formats and processes a user-level PHP error string. It logs to the native system error log, conditionally prints output based on your `display_errors` settings, and terminates scripts on fatal issues.

## Usage

```
errorMsg(int $e, string $msg = '', string $file = '', string|int $line = ''): ?bool
```

## Parameters

**e**
: Native PHP error level constants (e.g., E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE, E_USER_DEPRECATED)

**msg**
: The descriptive message for the log.

**file**
: Path to the file where the event occured. **^(optional)^**

**line**
: Specific code line number. **^(optional)^**

## Return Value

Returns `null` if global PHP error reporting is disabled (`error_reporting() === 0`), otherwise `true`.

> Automatically terminates script execution with an `exit(1)` code if passing `E_USER_ERROR`.

## Related Methods

[error](error.md) | [exceptionMsg](exceptionMsg.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Error Handling](../CoreyPHP.md#ErrorHandling)
