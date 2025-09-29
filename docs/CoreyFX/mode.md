# mode

Accepts a list or array of non-fractional real numbers and returns the value(s) that appear most frequently.

## Usage

```
mode(array|integer ...$args): integer|array
```

## Parameters

**args** (array|integer)
: A list or array of non-fractional real numbers.

## Return Value

Returns the mode of all non-fractional real numbers or an array if there are multiple modes.

Returns `0` if the input is empty or if there is no mode.

## Examples

```
$fx->mode(5, 7, 3, 5) = 5
$fx->mode([4, 8, 2, 8]) = 8
$fx->mode(1, 2, 5, 4) = 0
```

## Debug Errors

- Triggers a warning if the argument(s) contain any non-numeric or non-fractional values.

## Related Methods

[mean](mean.md) | [median](median.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
