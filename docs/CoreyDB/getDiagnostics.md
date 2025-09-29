# getDiagnostics

Gathers a comprehensive, hierarchical overview of the server environment, current database configuration, and the active table structure.

## Usage

```
getDiagnostics(): array
```

## Parameters

- Takes no arguments.

## Return Value

Returns an array with the following environmental data:

| Category | Key | Type | Retrieval Method | Source Query / Internal Property |
| --- | --- | --- | --- | --- |
| Server | version | string | On-Demand (Driver) | $this->db->server_info |
| Server | protocol | integer | On-Demand (Driver) | $this->db->protocol_version |
| Server | host_info | string | On-Demand (Driver) | $this->db->host_info |
| Server | engine | string | Cached (on connect) | SELECT @@default_storage_engine |
| Server | charset | string | Cached (on connect) | SELECT @@character_set_server |
| Server | collation | string | Cached (on connect) | SHOW VARIABLES LIKE 'collation_server' |
| Server | databases | array\|null | Class State | $this->databases (appended if populated) |
| Database | name | string | On-Demand (Config) | $this->getConfig('db.name') |
| Database | charset | string | On-Demand Query | SELECT @@character_set_database |
| Database | collation | string | On-Demand Query | SELECT @@collation_database |
| Database | tables | array\|null | Class State | $this->tables (appended if populated) |
| Table | name | string | Class State | $this->table |
| Table | engine | string | On-Demand Query | SHOW TABLE STATUS LIKE '$this->table' (Engine) |
| Table | collation | string | On-Demand Query | SHOW TABLE STATUS LIKE '$this->table' (Collation) |
| Table | columns | array\|null | Class State | $this->columns (appended if populated) |

> :pushpin: The `table` block will return `null` if no table has been explicitly set. The `databases`, `tables`, and `columns` arrays are dynamically appended only if their respective state lists within the class are populated.

## Examples

```
$db->getDiagnostics();
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| charset | utf8mb4 | *string* (See: ) | The database character set to use. |
| db\.name | null | *string* | Database name |
| engine | InnoDB | *string* (See: ) | The database engine to use when creating new databases. |

## Debug Errors

- No debug errors.

## Related Methods

[getHostInfo](getHostInfo.md) | [getProtocolVersion](getProtocolVersion.md) | [getServerVersion](getServerVersion.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Environment](../CoreyDB.md#environment)
