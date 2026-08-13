# diff

Accepts a list or array of real numbers and subtracts all subsequent values from the first element to return a result.

## Usage

```
diff(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

Returns the difference of all real numbers.

Returns `0` if the input is empty.

## Examples

```
$fx->diff(5, 7, 3) = -5
$fx->diff([4, 8, 2]) = -6
$fx->diff(1.2, 5.6, 3.4) = -7.8
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[sum](sum.md) | [product](product.md) | [quotient](quotient.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
