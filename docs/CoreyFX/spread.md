# spread

Accepts a list or array of real numbers and calculates the difference between the minimum and maximum values.

## Usage

```
spread(array|integer|float ...$args): float
```

## Parameters

**args** (array|integer|float)
: A list or array of real numbers.

## Return Value

(float)
: Returns the spread of all real numbers. (*Also known as the range which is a reserved word in php.*)
: Returns `0` if the input is empty.

## Examples

```
$fx->spread(5, 7, 3) = 4
$fx->spread([4, 8, 2]) = 6
$fx->spread(1.2, 5.6, 3.4) = 4.4
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

## Related Methods

[midrange](midrange.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Mathematical](../CoreyFX.md#mathematical)
