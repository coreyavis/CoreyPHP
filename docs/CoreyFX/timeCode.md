# timeCode

Converts a combination of hours, minutes, seconds and optional milliseconds into a timecode.

## Usage

```
timeCode(mixed $seconds = 0, integer $minutes = 0, integer $hours = 0, integer $ms = 0): string
```

## Parameters

**seconds** (mixed)
: Seconds to convert. Negative values and milliseconds allowed (ex. -12.345).

**minutes** (integer)
: Minutes to convert. Negative values allowed. *^(optional)^*

**hours** (integer)
: Hours to convert. Negative values allowed. *^(optional)^*

**ms** (integer)
: Milliseconds to convert. Negative values allowed. Integers only, no decimals. *^(optional)^*

> Values for minutes and seconds exceeding 59, and milliseconds exceeding 999, will be converted into the next time unit. (e.g., 75 seconds is converted to 1 minute and 15 seconds.)

## Return Value

Returns the formatted timecode representation of the given hours, minutes and seconds. Milliseconds are included only when provided.

> Format: `HH:MM:SS`   `-HH:MM:SS`   `HH:MM:SS.nnn`   `-HH:MM:SS.nnn`

## Examples

```
$fx->timeCode(59, 59, 23) = 23:59:59
$fx->timeCode(85567) = 23:46:07
$fx->timeCode(-85567) = -23:46:07
$fx->timeCode(1.2345) = 00:00:03.345
$fx->timeCode(1, 2, 3, 4567) = 03:02:05.567
$fx->timeCode(1, 2, 3, -4567) = 03:01:56.433
$fx->timeCode(1.2, 3, 4, 56) = 04:03:01.760
```

## Debug Errors

- Triggers a warning if invalid arguments are provided.

## Related Methods

[isTimecode](isTimeCode.md) | [timecodeConvert](timecodeConvert.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
