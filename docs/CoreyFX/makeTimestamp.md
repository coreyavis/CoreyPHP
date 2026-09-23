# makeTimestamp

Generates a Unix timestamp based on provided date and time components. If any component is invalid or omitted (daulting to `0`), the method automatically falls back to the current date or time value.

## Usage

```
makeTimestamp(integer $year = 0, integer $month = 0, integer $day = 0, integer $hour = 0, integer $minute = 0, integer $second = 0): integer
```

## Parameters

**year** (integer)
: The 4-digit year. Defaults to current year if invalid or `0`. (*default*: `0`) *^(optional)^*

**month** (integer)
: The month (1-12). Defaults to current month if invalid or `0`. (*default*: `0`) *^(optional)^*

**day** (integer)
: The day of the month (1-31). Defaults to current day if invalid or `0`. (*default*: `0`) *^(optional)^*

**hour** (integer)
: The hour in 24-hour format (0-23). Defaults to current hour if invalid or `0`. (*default*: `0`) *^(optional)^*

**minute** (integer)
: The minute (0-59). Defaults to current minute if invalid or `0`. (*default*: `0`) *^(optional)^*

**second** (integer)
: The second (0-59). Defaults to current second if invalid or `0`. (*default*: `0`) *^(optional)^*

> Named Arguments: Thanks to default values, PHP named arguments can be used to override specific components without passing placeholding zeros for earlier arguments.

## Return Value

(integer)
: Returns the calculated Unix timestamp as integer.

> :pushpin: If you need a timestamp for the current time without modifying any date/time components, use `timestamp()` directly. Calling `makeTimestamp()` with no arguments performs unnecessary regex validation and string concatenation before calling `timestamp()`.

## Examples

1. Target specific components (PHP 8+ Named Arguments)

Avoid passing long positional argument lists like (0, 0, 0, 5) by naming the target parameter:

```
// Custom month and day only
$fx->makeTimestamp(month: 12, day: 25);
```

2. Full custom timestamp:

```
// January 01, 2026 01:11:01
$fx->makeTimestamp(2026, 1, 1, 1, 11, 1) = 1767258661
```

## Debug Errors

- No debug errors.

## Related Methods

[timestamp](timestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
