# removeSession

Removes a single item from the active session.

## Usage

```
removeSession(string $key): bool
```

## Parameters

**key** (string)
: The key of the item to remove.

## Return Value

(bool)
: Returns `true` if successfully removed, or `false` if the key was not set.

## Examples

```
$cphp->removeSession('temp_data') = true|false
```

## Debug Errors

- Logs a notice if the session variable does not exist.

## Related Methods

[clearSession](clearSession.md) | [endSession](endSession.md) | [getSession](getSession.md) | [regenSession](regenSession.md) | [setSession](setSession.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
