# isAssoc

Determines if an array is associative. If strict, it validates that every key is a string; otherwise, it returns `true` if at least one string key is found. Useful for ensuring data integrity before SQL generation.

## Usage

```
isAssoc(array $array = [], bool $strict = false): bool
```

## Parameters

**array** (array)
: The array to validate as associative.

**strict** (bool)
: Strict validation check that every key is string. *^(optional)^*

## Return Value

Returns `true` on success and `false` on failure.

Returns `false` for empty arrays or non-array inputs.

## Examples

```
$cphp->isAssoc(['key' => 'value'], 1 => 'string') = true
$cphp->isAssoc(['string', 'value']) = false
$cphp->isAssoc([0 => 'value']) = false
$cphp->isAssoc(['key' => 'value', 1 => 'string'], true) = false
```

## Debug Errors

- No debug errors.

## Related Methods

[isJson](isJson.md) | [isSerial](isSerial.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Validation](../CoreyPHP.md#validation)
