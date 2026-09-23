# timeSum

Sums multiple time values - provided as timecode strings (including millisecond precision), interger/float seconds, or an array of mixed formats - and returns the formatted total timecode.

## Usage

```
method(mixed ...$args): string
```

## Parameters

**args** (mixed)
: Variadic argument accepting timecodes (e.g., `"01:15:30"` or `"01:15:30.500"`), numeric values in seconds/milliseconds (e.g., `90` or `1.5`), or a single array containing these formats.

> :pushpin: Millisecond precision: Supports sub-second accuracy in both timecode strings (e.g., `HH:MM:SS.mmm`) and fractional second numbers.

## Return Value

(string)
: Returns the formatted timecode representing the cumulative sum of all input arguments.

## Examples

```
$fx->timeSum('01:15:00', 30, '04:30') = "01:20:00"
$fx->timeSum('01:15:00.250', 30.5, '04:30:100') = "01:20:00.850"
$fx->timeSum(['10:00', '20:00', 120]) = "00:32:00"
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
