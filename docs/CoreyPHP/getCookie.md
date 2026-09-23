# getCookie

Retrieves and sanitizes cookie data. Automatically parses JSON-encoded cookie values into arrays.

## Usage

```
getCookie(?string $key = null): mixed
```

## Parameters

**key** (string|null)
: The name of the specific cookie to retrieve. If `null`, returns all available cookies in an associative array. (*default*: `null`) *^(optional)^*

## Return Value

(mixed)
: Returns the sanitized value (or array if JSON), or an associative array of all cookies (`key => value`).
: Returns `null` if `$key` is provided but does not exist.

## Examples

Retrieve a scalar cookie:

```
$cphp->getCookie('theme');
// Result: dark
```

Retrieve an array cookie (automatically parsed from JSON):

```
$cphp->getCookie('preferences');
// Result: ['notifications' => true, 'sidebar' => 'collapsed']
```

Retrieve all active cookies:

```
$cphp->getCookie();
```

## Debug Errors

- No debug errors.

## Related Methods

[removeCookie](removeCookie.md) | [setCookie](setCookie.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Cookie Management](../CoreyPHP.md#cookie-management)
