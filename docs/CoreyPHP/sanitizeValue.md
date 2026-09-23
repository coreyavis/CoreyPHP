# sanitizeValue *[Protected]*

Cleans individual scalar values (specifically strings) by removing security hazards like null bytes and stripping unnecessary surrounding whitespace.

> Part of a pair of complimentary internal helper methods used to sanitize incoming data structures (e.g., `$_COOKIE`, `$_POST`, or `$_SESSION` payloads) by cleaning raw strings and recursively traversing nested arrays.

## Usage

```
sanitizeValue(mixed $value): mixed
```

## Parameters

**value** (mixed)
: The scalar item or value to clean.

## Return Value

(mixed)
: Returns the cleaned, trimmed string, if value is a string.
: Returns the unchanged value if value is non-string (e.g., integer, float, bool, null).

## Examples

```
$cphp->sanitizeValue('admin\0 ');
// Result: admin
```

## Debug Errors

- No debug errors.

## Related Methods

[sanitizeData](sanitizeData.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Helpers](../CoreyPHP.md#helpers)
