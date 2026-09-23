# quotient

Accepts a list or array of real numbers and divides all subsequent values from the first element to return a result.

## Usage

```
quotient(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

(float)
: Returns the quotient of all real numbers.
: Returns `0` if the input is empty.
: Returns `false` if divisor is `0`.

> When the method calculates the quotient of a dataset, the resulting value may exceed the fixed-point precision limits of the output format. (ex. 0.0003 = 0)

## Examples

```
$fx->quotient(15, 5) = 3
$fx->quotient(5, 7, 3) = 0.24
$fx->quotient([4, 8, 2]) = 0.25
$fx->quotient(1.2, 5.6, 3.4) = 0.06
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- Triggers a warning if an argument is zero.

## Related Methods

[sum](sum.md) | [diff](diff.md) | [product](product.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
