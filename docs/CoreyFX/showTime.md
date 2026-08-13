# showTime

Formats a given timestamp or datetime string into a human-readable 12-hour time string with AM/PM. Defaults to the current time if no argument is provided.

## Usage

```
showTime(string|int|null $timestamp = null): string
```

## Parameters

**timestamp** (string|integer|null)
: A Unix timestamp (integer/numeric string), a parsable datetime string, or `null` for current time. (*default*: `null`) *^(optional)^*

## Return Value

Returns a formatted time string.

## Examples

```
// Current time
$fx->showTime();

// Unix timestamp
$fx->showTime(1700000000) = 2:13 PM

// String date format
$fx->showTime('2026-01-01 14:30:00') = 2:30 PM
```

## Debug Errors

- No debug errors.

## Related Methods

[showDate](showDate.md) | [showDatetime](showDatetime.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
