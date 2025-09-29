# timeConvert

Converts hours, minutes, seconds and optional milliseconds into seconds.

## Usage

```
timeConvert(mixed $seconds = 0, integer $minutes = 0, integer $hours = 0, integer $ms = 0): mixed
```

## Parameters

**seconds** (mixed)
: Seconds to convert. Negative values and milliseconds allowed (ex. -12.345)

**minutes** (integer)
: Minutes to convert. Negative values allowed. *^(optional)^*

**hours** (integer)
: Hours to convert. Negative values allowed. *^(optional)^*

**ms** (integer)
: Milliseconds to convert. Negative values allowed. Integers only, no decimals. *^(optional)^*

## Return Value

Returns the converted hours, minutes, seconds and milliseconds into a single value representing the total duration in seconds.

## Examples

```
$fx->timeConvert(59, 59, 23) = 86399
$fx->timeConvert(0, 0, 5) = 18000
$fx->timeConvert(-56, 34, 12) = 45184
$fx->timeConvert(56, -34, 12) = 41216
$fx->timeConvert(0.7, 0, 3) = 10800.700
$fx->timeConvert(1, 2, 3, 4567) = 10925.567
$fx->timeConvert(1, 2, 3, -4567) = 10916.433
```

## Debug Errors

- Triggers a warning if invalid arguments are provided.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
