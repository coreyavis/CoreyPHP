# timestamp

Generates a Unix timestamp from the provided date/time; otherwise, defaults to now.

## Usage

```
timestamp(?string $date): integer|bool
```

## Parameters

**date** (?string)
: A date/time string. `Null` by default. *^(optional)^*

## Return Value

Returns the Unix timestamp for a given date/time, or current time if *date* is `null`.

Returns `false` if the input is not valid date/time string.

## Examples

```
$fx->timestamp() = 0000000000 (current timestamp)
$fx->timestamp('July 29, 2015 3:45pm') = 1438209900
```

## Debug Errors

- No debug errors.

## Related Methods

[emailTimestamp](emailTimestamp.md) | [sqlTimestamp](sqlTimestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
