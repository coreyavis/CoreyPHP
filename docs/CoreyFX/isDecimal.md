# isDecimal

Validates if an integer has a decimal.

## Usage

```
isDecimal(mixed $num, array &$matches): bool
```

## Parameters

**num** (mixed)
: The number to validate.

**matches** (array)
: If matches is populated, then it returns an array that is filled with the results of the match. *^(optional)^*

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

If `$matches` is provided then an array is returned with the following:
| Key | Example | Description |
| --- | --- | --- |
| negative | -1.2 | `0` if positive and `1` if negative. |
| number | **1** | The whole number before the decimal. |
| decimal | **.2** | The decimal value. |
| whole | **2** | The decimal as a whole number. |
| match | **1.2** | The entire matching value. |

## Examples

```
$fx->isDecimal(1.2) = true
$fx->isDecimal(3) = false
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Validation](../CoreyFX.md#validation)
