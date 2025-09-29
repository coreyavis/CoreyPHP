# midrange

Accepts a list or array of real numbers and calculates the midpoint value.

## Usage

```
midrange(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

Returns the midpoint of all real numbers.

Returns `0` if the input is empty.

## Examples

```
$fx->midrange(5, 7, 3) = 5
$fx->midrange([4, 8, 2]) = 5
$fx->midrange(1.2, 5.6, 3.4) = 3.4
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[spread](spread.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
