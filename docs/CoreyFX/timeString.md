# timeString

Converts seconds or a timecode into an hours, minutes, seconds and even milliseconds string.

## Usage

```
timeString(mixed $seconds = 0): string
```

## Parameters

**seconds** (mixed)
: Seconds to convert to string. Also accepts a timecode.

## Return Value

Returns the converted seconds or timecode into a string containing hours, minutes, seconds and milliseconds if decimal is included.

## Examples

```
$fx->timeString(85567) = 23 hours 46 minutes 7 seconds
$fx->timeString(45:67) = 46 minutes 7 seconds
$fx->timeString(795.128) = 13 minutes 15 seconds 128 milliseconds
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| abbr | false | bool | Abbreviates hours to hrs, minutes to mins, etc. |

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
