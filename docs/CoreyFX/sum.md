# sum

Accepts a list or array of real numbers and adds them together to return a total.

## Usage

```
sum(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

(float)
: Returns the sum of all real numbers.
: Returns `0` if the input is empty.

## Examples

```
$fx->sum(5, 7, 3) = 15
$fx->sum([4, 8, 2]) = 14
$fx->sum(1.2, 5.6, 3.4) = 10.2
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[diff](diff.md) | [product](product.md) | [quotient](quotient.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
