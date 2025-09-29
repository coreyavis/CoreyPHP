# timeCodeConvert

Converts a timecode into seconds.

## Usage

```
timeCodeConvert(string $timecode = '00:00:00'): mixed
```

## Parameters

**timecode** (string)
: The timecode to convert.

## Return Value

Returns the converted timecode into a single integer value representing the total duration in seconds. Milliseconds are included only when provided.

Returns `false` if invalid timecode.

## Examples

```
$fx->timeCodeConvert('3:00') = 180
$fx->timeCodeConvert('23:45:67') = 85567
$fx->timeCodeConvert('-3:00') = -180
$fx->timeCodeConvert('23:45:67.8') = 85567.800
```

## Debug Errors

- Triggers a warning if the argument is not a valid timecode.

## Related Methods

[isTimecode](isTimeCode.md) | [timecode](timecode.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
