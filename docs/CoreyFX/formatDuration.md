# formatDuration

Calculates the time difference between two dates and returns a human-readable duration string with automatic pluralization and configurable unit abbreviations.

## Usage

```
formatDuration(string|integer $start = 0, string|integer $end = 0): string
```

## Parameters

**start** (string|integer)
: The starting point. Accepts date strings (`"2026-01-01 10:00:00"`), relative dates (`"-2 days"`), or Unix timestamps (`1700000000`). (*default*: `0`)

**end** (string|integer)
: The end point. Accepts the same formats as `$start`. Defaults to current system date/time if omitted or set to `0`. (*default*: `0`) *^(optional)^*

## Return Value

(string)
: Returns a space-separated list of active time components (e.g., `"1 year 2 months"`, `"45 minutes"`).
: Returns `"0 seconds"` (or `"0 secs"`) if `$start` is missing, invalid, or identical to `$end`.

## Examples

```
$fx->formatDuration('2024-01-01 00:00:00', '2026-03-05 04:15:30');
// Result: 2 years 2 months 4 days 4 hours 15 minutes 30 seconds
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| abbr | false | *bool* | Abbreviates certain words like hours to hrs. |

## Debug Errors

- Triggers a warning if the start date is omitted.
- Triggers a warning if an invalid date format is provided.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
