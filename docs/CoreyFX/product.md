# product

Accepts a list or array of real numbers and multiplies them together to return a total.

## Usage

```
product(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

(float)
: Returns the product of all real numbers.
: Returns `0` if the input is empty.

## Examples

```
$fx->product(15, 5) = 75
$fx->product(5, 7, 3) = 105
$fx->product([4, 8, 2]) = 64
$fx->product(1.2, 5.6, 3.4) = 22.85
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[sum](sum.md) | [diff](diff.md) | [quotient](quotient.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
