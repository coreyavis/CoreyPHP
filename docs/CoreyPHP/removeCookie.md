# removeCookie

Deletes a cookie by invalidating its expiration timestamp and sending matching domain/path header parameters.

## Usage

```
method(string $key): bool
```

## Parameters

**key** (string)
: The name of the cookie to remove.

## Return Value

Returns `true` if the removal header was successfully issued.

Returns `false` if the cookie does not exist in `$_COOKIE` (logs a notice error).

> :pushpin: Unsets `$_COOKIE[$key]` immediately so the cookie is unavailable in the current PHP script execution.

## Examples

```
$cphp->removeCookie('theme');
```

## Debug Errors

- Logs a notice if the cookie does not exist.

## Related Methods

[getCookie](getCookie.md) | [setCookie](setCookie.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Cookie Management](../CoreyPHP.md#cookie-management)
