# gcd

Greatest Common Divisor - Calculates the largest positive integer that divides two integers without leaving a remainder.

> NOTE: `gcd` provides the same functionality as `gcf` but accepts only two inputs.

## Usage

```
gcd(integer $a = 1, integer $b = 0): integer
```

## Parameters

**a** (integer)
: A positive real number.

**b** (integer)
: A positive real number.

## Return Value

(integer)
: Returns the Greatest Common Divisor for the two numbers.

## Examples

```
$fx->gcd(6, 12) = 3
$fx->gcd(30, 48) = 6
$fx->gcd(2, 3) = 1
```

## Debug Errors

- No debug errors.

## Related Methods

[gcf](gcf.md) | [lcm](lcm.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
