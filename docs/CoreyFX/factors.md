# factors

Computes the factors or prime factors of an integer.

## Usage

```
factors(integer $num = 1, bool $prime = false): array
```

## Parameters

**num** (integer)
: The number to factor.

**prime** (bool)
: If set to `true`, prime factors are returned instead. *^(optional)^*

## Return Value

(array)
: Returns an array of factors, or prime factors if optional boolean is set.

## Examples

```
$fx->factors(12) = [1, 2, 3, 4, 6, 12]
$fx->factors(12, true) = [2, 2, 3]
```

## Debug Errors

- Triggers a warning if non-positive integer is provided.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
