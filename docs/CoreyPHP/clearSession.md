# clearSession

Clears all session variables stored in memory (`$_SESSION`), while keeping the session active and the session ID intact.

## Usage

```
clearSession(): bool
```

## Parameters

- Takes no arguments.

## Return Value

(bool)
: Returns `true`, always.

## Examples

```
$cphp->clearSession();
```

## Debug Errors

- No debug errors.

## Related Methods

[endSession](endSession.md) | [getSession](getSession.md) | [regenSession](regenSession.md) | [removeSession](removeSession.md) | [setSession](setSession.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
