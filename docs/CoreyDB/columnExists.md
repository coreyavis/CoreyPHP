# columnExists *[Private]*

Verifies whether a specified column exists within the allowed internal column list.

## Usage

```
columnExists(string $column): bool
```

## Parameters

**column** (string)
: The name of the column to validate.

## Return Value

Returns `true` on success and `false` on failure.

## Examples

```
$db->columnExists('column') = true|false
```

## Debug Errors

- Logs a notice if the column does not exist.

## Related Methods

[databaseExists](databaseExists.md) | [tableExists](CoreyDB/tableExists.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Inspectors](../CoreyDB.md#inspectors)
