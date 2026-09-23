# mod

Divides the numerator by the denominator and returns the remainder.

## Usage

```
mod(string|integer|float $n = 0, integer|float $d = 1): float
```

## Parameters

**n** (string|integer|float)
: The numerator as an integer or float. Also accepts a fraction as string. (ex. '5/3')

**d** (integer|float)
: The denominator as integer or float. Default value is `1`. *^(optional)^*

## Return Value

(float)
: Returns the remainder as float.
: Returns `0` if there is no remainder.

## Examples

```
$fx->mod(5, 2) = 1
$fx->mod(17, 5) = 2
$fx->mod(2, 5) = 2
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- Triggers a warning if the denominator is equal to `0`

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
