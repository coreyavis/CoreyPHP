# nightlyBuild

Calculates the whole number of calendar days that have passed between a target date and today.

## Usage

```
nightlyBuild(string|integer|null $date = null): float
```

## Parameters

**date** (string|integer|null)
: A date string, Unix timestamp, or `null`.

## Return Value

Returns the number of days elapsed since `$date`.

Returns `0` if `$date` is `null` or unparseable.

## Examples

```
$file->nightlyBuild(strtotime('-10 days')) = 10
```

## Debug Errors

- No debug errors.

## Related Methods

[versionByTime](versionByTime.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Version Control](../CoreyFile.md#version-control)
