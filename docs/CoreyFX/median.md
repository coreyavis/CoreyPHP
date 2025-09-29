# median

Accepts a list or array of real numbers and returns the median value. The values are sorted numerically in ascending order; if the count is odd, it returns the middle element. If the count is even, it returns the arithmetic mean of the 2 central elements.

## Usage

```
median(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

Returns the median of all real numbers.

Returns `0` if the input is empty.

## Examples

```
$fx->median(5, 7, 3) = 5
$fx->median([4, 8, 2]) = 4
$fx->median(1.2, 5.6, 3.4) = 3.4
$fx->median(1, 2, 5, 4) = 3
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[mean](mean.md) | [mode](mode.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
