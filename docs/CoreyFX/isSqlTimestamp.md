# isSqlTimestamp

Validates if a string is a valid SQL timestamp.

## Usage

```
isSqlTimestamp(mixed $date, array &$matches): bool
```

## Parameters

**date** (mixed)
: The SQL timestamp to validate.

**matches** (array)
: If matches is populated, then it returns an array that is filled with the results of the match. **^(optional)^**

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

If `$matches` is provided then an array is returned with the following:
| Key | Example | Description |
| --- | --- | --- |
| timestamp | 1438209900 | SQL timestamp converted to Unix timestamp. |
| year | **YYYY**-MM-DD | SQL Timestamp year. |
| month | YYYY-**MM**-DD | SQL Timestamp month. |
| day | YYYY-MM-**DD** | SQL Timestamp day. |
| hour | **00**:00:00 | SQL Timestamp hour. |
| min | 00:**00**:00 | SQL Timestamp minutes. |
| sec | 00:00:**00** | SQL Timestamp seconds. |
| match | YYYY-MM-DD HH:MM:SS | Entire SQL timestamp match. |

## Examples

```
$fx->isSqlTimestamp('2015-07-29 15:45:00') = true
$fx->isSqlTimestamp('07-29-2015 15:45:00') = false
$fx->isSqlTimestamp('2015-29-07 15:45:00') = false
```

## Debug Errors

- No debug errors.

## Related Methods

[sqlTimestamp](sqlTimestamp.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Validation](../CoreyFX.md#validation)
