# decimals

Formats a number to a specified decimal length using standard rounding, with an optional string-formatting mode to maintain fixed trailing zeros for display.

## Usage

```
decimals(integer|float $arg = 0, integer $dp = -1, bool $asString = false): string|float
```

## Parameters

**arg** (integer|float)
: Number to round or format.

**dp** (integer)
: Number of decimals places. Defaults to 2 (configurable via the system config), but can be overridden using this argument. *^(optional)^*

**asString** (bool)
: If set to `true`, returns a string padded with trailing zeros to maintain exact fixed-point display. If `false`, returns a float. *^(optional)^*

## Return Value

Returns the rounded number as float, or as a string if `$asString` is set to `true`.

## Examples

```
$fx->decimals(3.1415) = 3.14 (float)
$fx->decimals(3.1415, 3) = 3.142 (float)
$fx->decimals(3.14, 3) = 3.14 (float)
$fx->decimals(3.14, 3, true) = "3.140" (string)
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Formatting](../CoreyPHP.md#formatting)
