# error

The class uses a central, internal router to classify issue severity using an `ErrorType` mapping system. While you cannot call this method externally, it's behavior modifies how code executes based on your `debug` configuration.

## Usage

```
error(string $msg = '', ErrorType|string $type = ErrorType::Notice): bool
```

## Parameters

**msg**
: The descriptive message for the log.

**type**
: The error type as ErrorType or string. (**default**: ErrorType::Notice)

| ErrorType's | Behavior when `debug => true` | Behavior when `debug => false`  |
| --- | --- | --- |
| ErrorType::Error or 'error' | Throws `\Exception` | `\Exception` |
| ErrorType::Warning or 'warning' | Throws `\Exception` | Triggers native `E_USER_WARNING` |
| ErrorType::Notice or 'notice' | Triggers native `E_USER_NOTICE` | Triggers native `E_USER_NOTICE` |
| ErrorType:Deprecated or 'deprecated' | Triggers native `E_USER_DEPRECATED` | Triggers native `E_USER_DEPRECATED` |

## Return Value

(bool)
: Returns `false` on completion.

## Related Methods

[errorMsg](errorMsg.md) | [exceptionMsg](exceptionMsg.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Error Handling](../CoreyPHP.md#ErrorHandling)
