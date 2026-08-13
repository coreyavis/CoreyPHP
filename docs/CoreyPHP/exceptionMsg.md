# exceptionMsg

Accepts a caught exception object, generates a stylized developer debug block, writes to the server error log, and strictly halts script execution.

## Usage

```
exceptionMsg(\Throwable $exception): void
```

## Parameters

**exception**
: Any native object implementing PHP's Throwable interface (Exceptions or Errors).

## Return Value

Returns no value.

> Terminates execution via `exit(1)`. The stylish debug visual will render to the screen only if `display_errors` is enabled or if the [debug](../Config.md#developer-config) configuration option evaluates to `true`.

## Related Methods

[error](error.md) | [errorMsg](errorMsg.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Error Handling](../CoreyPHP.md#ErrorHandling)
