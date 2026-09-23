# setSession

Sanitizes the key and value through internal sanitization methods before persisting the data into `$_SESSION`.

## Usage

```
setSession(string $key, mixed $value): bool
```

## Parameters

**key** (string)
: The key under which the data will be stored.

**value** (mixed)
: The data value to store (string, array, boolean, etc.).

## Return Value

(bool)
: Returns `true`, always. 

## Examples

```
$cphp->setSession('user_id', 42);
$cphp->setSession('profile', ['username' => 'name', 'role' => 'admin']);
```

## Debug Errors

- No debug errors.

## Related Methods

[clearSession](clearSession.md) | [endSession](endSession.md) | [getSession](getSession.md) | [regenSession](regenSession.md) | [removeSession](removeSession.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
