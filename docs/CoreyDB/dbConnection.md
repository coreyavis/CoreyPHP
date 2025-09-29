# dbConnection

Initializes the MySQL connection. Manual execution is only required if the database name was omitted during instantiation; otherwise, the connection is established automatically via the constructor.

## Usage

```
dbConnection(?string $dbname, ?string $dbuser, ?string $dbpass, ?string $dbhost): static
```

## Parameters

**dbname** (?string)
: The name of the database to establish a connection with.

**dbuser** (?string)
: The database username. *^(optional)^*

**dbpass** (?string)
: The database password. *^(optional)^*

**dbhost** (?string)
: The database host name. *^(optional)^*

> `dbuser`, `dbpass` and `dbhost` are optional because there are default values already set within the configuration that you can use.

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$db->dbConnection('mydb', 'username', 'password', 'localhost');
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| db.host | localhost | string | Database host name |
| db\.name | null | string | Database name |
| db.user | root | string | Database username |
| db.pass | root | string | Database password |

## Debug Errors

- Throws an exception if database name, username, password or host are not specified.
- Throws an exception if the connection fails.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Environment](../CoreyDB.md#environment)
