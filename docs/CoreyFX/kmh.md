# kmh

Calculates kilometers per hour (km/h) given distance in meters and time in seconds.

## Usage

```
kmh(integer|float $distance = 0, integer|float $time = 60, bool $asString = false): string|float
```

## Parameters

**distance** (integer|float)
: Distance traveled in meters (can include decimals).

**time** (integer|float)
: Travel time in seconds (can include decimals). Defaults to 60 seconds (1 minute).

**asString** (bool)
: If set to `true`, returns value as string with appended "km/h". *^(optional)^*

## Return Value

Returns kilometers per hour as a float, or a string depending on the optional boolean argument.

## Examples

```
$fx->kmh(150, 6) = 90
$fx->kmh(45, 3, true) = 54.00 km/h
$fx->kmh(443.21, 59.63) = 26.76
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- Triggers a warning if any argument is not greater than zero.

## Related Methods

[mph](mph.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Formulas](../CoreyFX.md#formulas)
