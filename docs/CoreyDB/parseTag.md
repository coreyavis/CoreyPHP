# parseTag

Parses a formatted tag string, extracts its identifier using a predefined regular expression pattern, and replaces it with its dynamically evaluated value.

## Usage

```
method(string $tag): string|integer
```

## Parameters

**tag** (string)
: The raw tag string to be evaluated (e.g., `[datetime]`).

| Tag | Keyword | Output Type | Description |
| --- | --- | --- | --- | --- |
| [date] | date | string | Current date formatted as `Y-m-d`. |
| [datetime] | datetime | string | Current date and time formatted as `Y-m-d H:i:s`. |
| [time] | time | string | Current time formatted as `H:i:s`. |
| [timestamp] | timestamp | integer | Current Unix timestamp. |

## Return Value

Returns the dynamically resolved value of the matched tag. If the tag format is unrecognized, or if the keyword inside the tag is invalid, the original tag string is returned unmodified.

## Examples

```
$db->parseTag('[datetime]') = YYYY-MM-DD HH:MM:SS (current date and time)
```

## Debug Errors

- Triggers a warning if the tag is invalid.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Utilities](../CoreyDB.md#utilities)
