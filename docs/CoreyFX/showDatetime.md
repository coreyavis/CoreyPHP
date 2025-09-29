# showDatetime

Formats a given timestamp or datetime string into a combined human-readable date and time string. Defaults to the current date and time if no argument is provided.

## Usage

```
showDatetime(string|int|null $timestamp = null, bool $abbr = false): string
```

## Parameters

**timestamp** (string|integer|null)
: A Unix timestamp (integer/numeric string), a parsable datetime string, or `null` for current time. (*default*: `null`) *^(optional)^*

**abbr** (bool)
: Abbreviate the month (e.g., `November` becomes `Nov`). (*default*: `false`) *^(optional)^*

## Return Value

Returns a formatted datetime string.

## Examples

```
// Current date and time
$fx->showDatetime();

// Unix timestamp with abbreviation
$fx->showDatetime(1700000000, true) = Nov 14, 2023 2:13 PM

// String date format
$fx->showDatetime('2026-01-01 14:30:00') = January 01, 2026 2:30 PM
```

## Debug Errors

- No debug errors.

## Related Methods

[showDate](showDate.md) | [showTime](showTime.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
