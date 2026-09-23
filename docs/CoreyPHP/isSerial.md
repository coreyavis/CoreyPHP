# isSerial

Validates if the provided data is formatted as a PHP serialized string.

## Usage

```
isSerial(mixed $data = null): bool
```

## Parameters

**array** (mixed)
: The data to validate as serialized.

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

## Examples

```
$cphp->isSerial('a:1:{i:0;s:5:"value";}') = true
$cphp->isSerial([0 => 'value']) = false
$cphp->isSerial(1) = false
```

## Debug Errors

- Logs a notice if the argument is empty.

## Related Methods

[isAssoc](isAssoc.md) | [isJson](isJson.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Validation](../CoreyPHP.md#validation)
