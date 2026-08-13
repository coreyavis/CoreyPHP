# gcf

Greatest Common Factor - Calculates the largest positive integer that divides integers without leaving a remainder.

> NOTE: `gcf` provides the same functionality as `gcd` but accepts an arbitrary number of inputs.

## Usage

```
gcf(array|integer ...$args): integer
```

## Parameters

**args** (array|integer)
: A list or array of positive real numbers.

## Return Value

Returns the Greatest Common Factor for the set of numbers.

Returns `0` if the input is empty.

## Examples

```
$fx->gcf(5, 10, 15) = 5
$fx->gcf(4, 10, 50) = 2
$fx->gcf(8, 12, 36) = 4
```

## Debug Errors

- No debug errors.

## Related Methods

[gcd](gcd.md) | [lcm](lcm.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
