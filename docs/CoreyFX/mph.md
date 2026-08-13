# mph

Calculates miles per hour (mph) given distance in feet and time in seconds.

## Usage

```
mph(integer|float $distance = 0, integer|float $time = 60, bool $asString = false): string|float
```

## Parameters

**distance** (integer|float)
: Distance traveled in feet (can include decimals).

**time** (integer|float)
: Travel time in seconds (can include decimals). Defaults to 60 seconds (1 minute).

**asString** (bool)
: If set to `true`, returns value as string with appended "mph". *^(optional)^*

## Return Value

Returns miles per hour as a float, or a string depending on the optional boolean argument.

## Examples

```
$fx->mph(150, 6) = 17.05
$fx->mph(45, 3, true) = 10.23 mph
$fx->mph(443.21, 59.63) = 5.07
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 2 | integers | Decimal points |

## Debug Errors

- Triggers a warning if any argument is not greater than zero.

## Related Methods

[kmh](kmh.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Formulas](../CoreyFX.md#formulas)
