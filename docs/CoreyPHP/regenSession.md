# regenSession

Regenerates the current session ID. This should be called during state/privilege changes (e.g., post-login) to protect against session fixation attacks.

## Usage

```
regenSession(bool $deleteOldSession = true): bool
```

## Parameters

**deleteOldSession** (bool)
: Whether to delete the old associative session file/data. (*default*: `true`) *^(optional)^*

## Return Value

Returns `true` on success, or `false` if no active session exists.

## Examples

```
// User completes login process
if ($userAuthenticated) {
    $cphp->regenSession();
    $cphp->setSession('logged_in', true);
}
```

## Debug Errors

- No debug errors.

## Related Methods

[clearSession](clearSession.md) | [endSession](endSession.md) | [getSession](getSession.md) | [removeSession](removeSession.md) | [setSession](setSession.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
