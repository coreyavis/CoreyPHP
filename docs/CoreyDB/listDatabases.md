# listDatabases

Retrieves an array of available databases. To optimize performance, it caches the results in the `$this->databases` variable after the first retrieval. Subsequent calls read from this variable instead of querying the MySQL server, unless a refresh is forced.

This method automatically filters out system databases defined in the configuration blacklist. To retrieve all databases including blacklisted ones, use `show('databases')` instead.

## Usage

```
listDatabases(bool $refresh = false): array
```

## Parameters

**refresh** (bool)
: If set to `true`, bypasses the cached `$this->databases` variable and forces a fresh query to the MySQL server. (*default*: `false`) *^(optional)^*

## Return Value

(array)
: Returns an array of database names on success (excluding blacklisted databases), or an empty array otherwise.

## Examples

```
$databases = $db->listDatabases();
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| blacklist | ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'] | *array* | Databases to ignore |

## Debug Errors

- No debug errors.

## Related Methods

[listColumns](listColumns.md) | [listTables](listTables.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Structure](../CoreyDB.md#structure)
