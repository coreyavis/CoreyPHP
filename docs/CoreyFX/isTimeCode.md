# isTimeCode

Validates if a string is a valid timecode.

## Usage

```
isTimeCode(mixed $time, array &$matches): bool
```

## Parameters

**time** (mixed)
: The timecode to validate.

**matches** (array)
: If matches is populated, then it returns an array that is filled with the results of the match. *^(optional)^*

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

If `$matches` is provided then an array is returned with the following:
| Key | Example | Description |
| --- | --- | --- |
| negative | -00:00:00 | `0` if positive and `1` if negative. |
| hours | **00**:00:00 | Hours in timecode. |
| minutes | 00:**00**:00 | Minutes in timecode. |
| seconds | 00:00:**00** | Seconds in timecode. |
| ms | 00:00:00.**000** | Milliseconds in timecode if included. |
| timecode | HH:MM:SS.nnn | Full formatted timecode provided to method. |

## Examples

```
$fx->isTimeCode('00:00:00') = true
$fx->isTimeCode(123) = false
```

## Debug Errors

- No debug errors.

## Related Methods

[timecode](timecode.md) | [timecodeConvert](timecodeConvert.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Validation](../CoreyFX.md#validation)
