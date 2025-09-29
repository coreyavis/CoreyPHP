# emailTimestamp

Generates an email timestamp from the provided date/time; otherwise, defaults to now.

## Usage

```
emailTimestamp(string|integer|null $date = null): string
```

## Parameters

**date** (string|integer|null)
: A date/time string or Unix timestamp. `Null` by default. *^(optional)^*

## Return Value

Returns the email timestamp for a given date/time, or current time if *date* is `null`.

## Examples

```
$fx->emailTimestamp() = Weekday, Day Month Year Timecode UTC (current date and time)
$fx->emailTimestamp('July 29, 2015 3:45pm') = Wed, 29 Jul 2015 15:45:00 -0700
$fx->emailTimestamp(1438209901) = Wed, 29 Jul 2015 15:45:01 -0700
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlTimestamp](sqlTimestamp.md) | [timestamp](timestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
