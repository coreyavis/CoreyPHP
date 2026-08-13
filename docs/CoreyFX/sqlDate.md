# sqlDate

Generates a SQL date from the provided date or date/time; otherwise, defaults to now.

## Usage

```
sqlDate(string|integer|null $datetime): string
```

## Parameters

**datetime** (string|integer|null)
: A date string, date/time string or Unix timestamp. (*default*: `null`) *^(optional)^*

## Return Value

Returns the SQL date for a given date or date/time, or current time if *datetime* is `null`.

## Examples

```
$fx->sqlDate() = YYYY-MM-DD (current date)
$fx->sqlDate('July 29, 2015 3:45pm') = 2015-07-29
$fx->sqlDate(1438209900) = 2015-07-29
$fx->sqlDate('-1 week') = YYYY-MM-DD (1 week ago)
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlTime](sqlTime.md) | [sqlTimestamp](sqlTimestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
