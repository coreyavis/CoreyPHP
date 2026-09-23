# sqlTimestamp

Generates a SQL timestamp from the provided date/time; otherwise, defaults to now.

## Usage

```
sqlTimestamp(string|integer|null $datetime): string
```

## Parameters

**datetime** (string|integer|null)
: A date/time string or Unix timestamp. (*default*: `null`) *^(optional)^*

## Return Value

(string)
: Returns the SQL timestamp for a given date/time, or current time if *datetime* is `null`.

## Examples

```
$fx->sqlTimestamp() = YYYY-MM-DD HH:MM:SS (current date and time)
$fx->sqlTimestamp('July 29, 2015 3:45pm') = 2015-07-29 15:45:00
$fx->sqlTimestamp(1438209900) = 2015-07-29 15:45:00
$fx->sqlTimestamp('-1 week') = YYYY-MM-DD HH:MM:SS (1 week ago)
```

## Debug Errors

- No debug errors.

## Related Methods

[emailTimestamp](emailTimestamp.md) | [isSqlTimestamp](isSqlTimestamp.md) | [sqlDate](sqlDate.md) | [sqlTime](sqlTime.md) | [timestamp](timestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
