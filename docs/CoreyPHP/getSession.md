# getSession

Retrieves a specific session value by key, or returns the full `$_SESSION` superglobal if no key is supplied.

## Usage

```
getSession(?string $key = null): mixed
```

## Parameters

**key** (?string)
: The name of the session variable to retrieve, or `null` for entire session. (*default*: `null`) *^(optional)^*

## Return Value

Returns the value associated with the key, `null` if the key doesn't exist, or the full `$_SESSION` array if `$key` is `null`.

## Examples

Retrieve a specific key:

```
$user_id = $cphp->getSession('user_id');
```

Retrieve all session data:

```
$allData = $cphp->getSession();
``` 

## Debug Errors

- No debug errors.

## Related Methods

[clearSession](clearSession.md) | [endSession](endSession.md) | [regenSession](regenSession.md) | [removeSession](removeSession.md) | [setSession](setSession.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Session Management](../CoreyPHP.md#session-management)
