# fileDate

Formats a Unix timestamp into a standardized date string based on the class's internal date format constant. If no timestamp is provided, it defaults to the current system time.

## Usage

```
fileDate(int $date = 0): string
```

## Parameters

**date** (integer)
: A Unix timestamp. *^(optional)^*

## Return Value

(string)
: Returns the formatted date string.

> :pushpin: This method simplifies date formatting across your application by enforcing a consistent format defined by the `self::DATEFORMAT` class constant. It safely handles fallback logic; if a timestamp of `0` or less is passed, it automatically uses the current time via `time()`.

## Examples

```
$file->fileDate() = 'MM/DD/YYYY MM:SS AM|PM'
``` 

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Date and Time](../CoreyFile.md#date-and-time)
