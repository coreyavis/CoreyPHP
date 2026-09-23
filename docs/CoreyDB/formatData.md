# formatData *[Protected]*

This method is an internal structural utility. It acts as a data-mapping transformer engine that automatically intercepts raw database record arrays returned by MySQLi and reshapes them to match your fluid chain configuration settings (`filter` and `output`).

## Usage

```
formatData(mixed $data): mixed
```

## Parameters

**data** (mixed)
: The raw associative array output fetched via `MYSQLI_ASSOC`.

## Return Value

(mixed)
: Returns your query results as a cleanly unwrapped value, array, object, or string format, dynamically matching your specified `->output()` configuration.

### Empty Result Fallback

When passed an empty dataset (zero records found), this method bypasses structural unwrapping and flattens into the following fixed type formats:

| Configured Output Type | Returned Empty Representation | Description / Use Case |
| --- | --- | --- |
| array | `[]` | Safe for un-nested `foreach` loops. |
| json | `"[]"` | Keeps frontend/API clients from crashing on parsing. |
| object | `stdClass Object ()` | Protects OOP accessors from calling methods on non-objects. |
| serial | `"a:0:{}"` | Can be safely serialzed/unserialized natively. |
| integer | `0` | Math-safe fallback for empty numeric operations or counts. |
| string | `''` (*empty string*) | Represents the semantic absence of text. |
| auto | `null` | Perfect for quick null-coalescing operations (`??`). |

## Examples

```
$db->formatData($data);
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| output | auto | *string* (See: [Output](CoreyDB/output.md)) | Default output data type. |

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
