# endSession

Completely destroyes the session. Clears memory variables, deletes the session cookie from the client browser with matching parameters, and destroys the session storage on the server.

## Usage

```
endSession(): bool
```

## Parameters

- Takes no arguments.

## Return Value

(bool)
: Returns `true`, always.

## Examples

```
$cphp->endSession();
```

## Debug Errors

- No debug errors.

## Related Methods

[clearSession](clearSession.md) | [getSession](getSession.md) | [regenSession](regenSession.md) | [removeSession](removeSession.md) | [setSession](setSession.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
