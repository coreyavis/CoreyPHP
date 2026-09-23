# tableExists *[Private]*

Verifies whether a specified table exists within the allowed internal table list.

## Usage

```
tableExists(string $table): bool
```

## Parameters

**table** (string)
: The name of the table to validate.

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

## Examples

```
$db->tableExists('table') = true|false
```

## Debug Errors

- Logs a notice if the table does not exist.

## Related Methods

[columnExists](columnExists.md) | [databaseExists](databaseExists.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Inspectors](../CoreyDB.md#inspectors)
