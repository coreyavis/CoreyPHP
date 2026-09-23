# showDate

Formats a given timestamp or datetime string into a human-readable date string. Defaults to the current date if no argument is provided.

## Usage

```
showDate(string|int|null $timestamp = null, bool $abbr = false): string
```

## Parameters

**timestamp** (string|integer|null)
: A Unix timestamp (integer/numeric string), a parsable datetime string, or `null` for current time. (*default*: `null`) *^(optional)^*

**abbr** (bool)
: Abbreviate the month (e.g., `November` becomes `Nov`). (*default*: `false`) *^(optional)^*

## Return Value

(string)
: Returns a formatted date string.

## Examples

```
// Current date
$fx->showDate();

// Unix timestamp with abbreviation
$fx->showDate(1700000000, true) = Nov 14, 2023

// String date format
$fx->showDate('2026-01-01 14:30:00') = January 01, 2026
```

## Debug Errors

- No debug errors.

## Related Methods

[showDatetime](showDatetime.md) | [showTime](showTime.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
