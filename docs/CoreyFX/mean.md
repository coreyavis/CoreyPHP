# mean

Accepts a list or array of real numbers and returns the arithmetic mean (also known as the average) by calculating the sum and dividing by the total count.

## Usage

```
mean(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

Returns the mean (also known as the average) of all real numbers.

Returns `0` if the input is empty.

## Examples

```
$fx->mean(5, 7, 3) = 5
$fx->mean([4, 8, 2]) = 4.67
$fx->mean(1.2, 5.6, 3.4) = 3.4
$fx->mean(1, 2, 5, 4) = 3
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[median](median.md) | [mode](mode.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
