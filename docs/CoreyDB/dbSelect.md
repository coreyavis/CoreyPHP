# dbSelect

Updates the active MySQL database selection for the current connection.

## Usage

```
dbSelect(string $dbname): bool
```

## Parameters

**dbname** (string)
: The name of the database selection.

## Return Value

Returns `true` on success and `false` on failure.

## Examples

```
$fx->dbSelect('mynewdb');
```

## Debug Errors

- Throws an exception if no database connection exists.
- Throws an exception if the database does not exist or is blacklisted.
- Triggers a warning if unable to select database.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Environment](../CoreyDB.md#environment)
