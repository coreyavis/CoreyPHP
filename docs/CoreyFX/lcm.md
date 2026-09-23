# lcm

Least Common Multiple - Calculates the smallest positive integer that is divisible by each of the numbers.

## Usage

```
lcm(array|integer ...$args): integer
```

## Parameters

**args** (array|integer)
: A list or array of real numbers.

## Return Value

(integer)
: Returns the Least Common Multiple for the set of numbers.
: Returns `0` if the input is empty.

## Examples

```
$fx->lcm(2, 3, 4) = 12
$fx->lcm([3, 7, 21]) = 21
$fx->lcm(2, 7, 10) = 70
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[gcd](gcd.md) | [gcf](gcf.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
