# listTables

Retrieves an array of available tables. To optimize performance, it caches the results in the `$this->tables` variable after the first retrieval. Subsequent calls read from this variable instead of querying the MySQL server, unless a refresh is forced.

## Usage

```
listTables(bool $refresh = false): array
```

## Parameters

**refresh** (bool)
: If set to `true`, bypasses the cached `$this->tables` variable and forces a fresh query to the MySQL server. (*default*: `false`) *^(optional)^*

## Return Value

(array)
: Returns an array of table names on success, or an empty array otherwise.

## Examples

```
$tables = $db->listTables();
```

## Debug Errors

- Logs a notice if no database to list columns from has been defined.

## Related Methods

[listColumns](listColumns.md) | [listDatabases](listDatabases.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Structure](../CoreyDB.md#structure)
