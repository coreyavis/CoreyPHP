# listColumns

Retrieves an array of available columns. To optimize performance, it caches the results in the `$this->columns` variable after the first retrieval. Subsequent calls read from this variable instead of querying the MySQL server, unless a refresh is forced.

## Usage

```
listColumns(bool $refresh = false): array
```

## Parameters

**refresh** (bool)
: If set to `true`, bypasses the cached `$this->columns` variable and forces a fresh query to the MySQL server. (*default*: `false`) *^(optional)^*

## Return Value

(array)
: Returns an array of column names on success, or an empty array otherwise.

## Examples

```
$columns = $db->listColumns();
```

## Debug Errors

- Logs a notice if no table to list columns from has been defined.

## Related Methods

[listDatabases](listDatabases.md) | [listTables](listTables.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Structure](../CoreyDB.md#structure)
