# getTable

Retrieves the persistant table name for the current database instance.

## Usage

```
getTable(): string|null
```

## Parameters

- Takes no arguments.

## Return Value

Returns the current table name or `null` if no table has been defined.

## Examples

```
$db->getTable() = users
``` 

## Debug Errors

- No debug errors.

## Related Methods

[setTable](setTable.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Structure](../CoreyDB.md#structure)
