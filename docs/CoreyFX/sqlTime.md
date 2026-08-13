# sqlTime

Generates a SQL time from the provided time or date/time; otherwise, defaults to now.

## Usage

```
sqlTime(string|integer|null $datetime): string
```

## Parameters

**datetime** (string|integer|null)
: A time string, date/time string or Unix timestamp. (*default*: `null`) *^(optional)^*

## Return Value

Returns the SQL time for a given time or date/time, or current time if *datetime* is `null`.

## Examples

```
$fx->sqlTime() = HH:MM:SS (current time)
$fx->sqlTime('July 29, 2015 3:45pm') = 15:45:00
$fx->sqlTime(1438209900) = 15:45:00
$fx->sqlTime('-1 hour') = HH:MM:SS (1 hour ago)
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlDate](sqlDate.md) | [sqlTimestamp](sqlTimestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
