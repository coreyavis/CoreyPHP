# timer

This method serves as a high-precision execution tracker using PHP's `microtime`. It allows for measuring the total duration of a script or specific code blocks, with built-in support for *lap* intervals. This is particularly useful for profiling performance and identifying slow-running processes.

## Usage

```
timer(bool $lap = false): float
```

## Parameters

**lap** (bool)
: Captures the elapsed time from the start without stopping the timer, allowing for multi-stage profiling. *^(optional)^*

## Return Value

Returns the elapsed microtime on *lap* or *stop* calls; returns `0` on *start*.

## Examples

```
$fx->timer() = 0 (start of timer)
$fx->timer(true) = 0.00035 (lap interval from start)
$fx->timer() = 0.00164 (stop of timer)
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| dp | 5 | integers | Decimal points |
| **Note**: Anything less than 3 decimal places will probably return 0. ||||
| override | false | bool | Can override the dp minimum of 5. |

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Date and Time Processing](../CoreyFX.md#date-and-time-processing)
