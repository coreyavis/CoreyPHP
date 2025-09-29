# setTable

Sets and validates the persistant table name for the current database instance. All subsequent queries will target this table until changed by a follow-up call to this method. To minimize database overhead, table existence checks are cached internally after the first validation.

## Usage

```
setTable(string $table): static
```

## Parameters

**table** (string)
: The name of the new table selection.

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$db->setTable('users');
$db->setTable('users')->select('*')->where()->execute();
// Result: SELECT * FROM `users` WHERE 1
``` 

## Debug Errors

- Throws an exception if no database connection exists.
- Throws an exception if the table does not exist.

## Related Methods

[getTable](getTable.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Structure](../CoreyDB.md#structure)
