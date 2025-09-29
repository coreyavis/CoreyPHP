# databaseExists *[Private]*

Verifies whether a specified database exists within the allowed internal database list and is not blacklisted.

## Usage

```
databaseExists(string $dbname): bool
```

## Parameters

**dbname** (string)
: The name of the database to validate.

## Return Value

Returns `true` on success and `false` on failure.

## Examples

```
$db->databaseExists('dbname') = true|false
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| blacklist | ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'] | *array* | Databases to ignore |
| db\.name | null | *string* | Database name |

## Debug Errors

- Throws an exception if the database does not exist or is blacklisted.

## Related Methods

[columnExists](columnExists.md) | [tableExists](CoreyDB/tableExists.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Inspectors](../CoreyDB.md#inspectors)
