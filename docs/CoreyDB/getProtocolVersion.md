# getProtocolVersion

Retrieves the MySQL protocol version used by the current connection.

> :pushpin: This information is also automatically collected and included in the global report returned by [getDiagnostics()](getDiagnostics.md).

## Usage

```
getProtocolVersion(): integer
```

## Parameters

- Takes no arguments.

## Return Value

(integer)
: Returns an integer representing the MySQL protocol version.

## Examples

```
$db->getProtocolVersion()
```

## Debug Errors

- No debug errors.

## Related Methods

[getDiagnostics](getDiagnostics.md) | [getHostInfo](getHostInfo.md) | [getServerVersion](getServerVersion.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Environment](../CoreyDB.md#environment)
