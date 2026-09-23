# sanitizeData *[Protected]*

Recursively processes scalar values, nested array structures, and objects, ensuring every key, property name, and value is sanitized.

> Part of a pair of complimentary internal helper methods used to sanitize incoming data structures (e.g., `$_COOKIE`, `$_POST`, or `$_SESSION` payloads, or decoded object payloads) by cleaning raw strings and recursively traversing nested arrays and object properties.

## Usage

```
sanitizeData(mixed $data): mixed
```

## Parameters

**data** (mixed)
: The input value to sanitize. Can be a string, integer, float, boolean, array, object, or `null`.

> Array keys, object property names, array values, and public object property values are all passed through `sanitizeValue()` to protect against key injection attacks and hidden null-byte characters.

## Return Value

(mixed)
: Returns the sanitized data structure with identical nesting and object types preserved. Objects are cloned during processing to prevent direct mutation of the original reference.

## Examples

Sanitizing Nested Arrays:

```
$cphp->sanitizeData(['user\0' => 'name ', 'role' => 'Admin\0 ']);
// Result: ['user' => 'name', 'role' => 'Admin']
```

Sanitizing Objects:

```
$cphp->sanitizeData((object)['user\0' => 'name ', 'role' => 'Admin\0 ']);
// Result: stdClass object { "user" => "name", "role" => "Admin" }
```

## Debug Errors

- No debug errors.

## Related Methods

[sanitizeValue](sanitizeValue.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Helpers](../CoreyPHP.md#helpers)
