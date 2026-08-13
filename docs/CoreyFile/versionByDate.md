# versionByDate

Generates a standard Calendar Versioning string in the format `YYYY.MM.PATCH`. Ideal for public or scheduled feature releases.

## Usage

```
versionByDate(string|integer|null $date = null, integer $patch = 0): string
```

## Parameters

**date** (string|integer|null)
: A date string, Unix timestamp, or `null` for current date.

**patch** (integer)
: The patch/bugfix iteration number. (*default*: `0`) *^(optional)^*

## Return Value

Returns the formatted version string (`YYYY.MM.PATCH`) or `'0.0.0'` on parse failure.

## Examples

```
$file->versionByDate('2026-05-15', 2) = "2026.05.2"
```

## Debug Errors

- No debug errors.

## Related Methods

[versionByTime](versionByTime.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Version Control](../CoreyFile.md#version-control)
