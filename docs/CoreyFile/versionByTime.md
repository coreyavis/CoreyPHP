# versionByTime

Generates a granular, build-level version string in the format `YYYY.DayOfYear.Hour`. Useful for continuous integration, dev builds, and asset tracking.

## Usage

```
versionByTime(string|integer|null $time = null, bool $nightly = false): string
```

## Parameters

**time** (string|integer|null)
: A date/time string, Unix timestamp, or `null` for current time.

**nightly** (bool)
: If set to `true`, appends `-N` (days elapsed since build date). (*default*: `false`) *^(optional)^*

## Return Value

Returns a formatted version string (`YYYY.DDD.H`) or `'0'` on parse failure.

## Examples

```
$file->versionByTime('2026-05-15 14:30:00') = '2026.135.14'
$file->versionByTime('2026-05-15 14:30:00', true) = '2026.135.14-89'
```

## Debug Errors

- No debug errors.

## Related Methods

[nightlyBuild](nightlyBuild.md) | [versionByDate](versionByDate.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Version Control](../CoreyFile.md#version-control)
