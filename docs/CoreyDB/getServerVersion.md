# getServerVersion

Retrieves the software version string of the connected MySQL server.

> :pushpin: This information is also automatically collected and included in the global report returned by [getDiagnostics()](getDiagnostics.md).

## Usage

```
getServerVersion(): string
```

## Parameters

- Takes no arguments.

## Return Value

Returns the software version of the connected MySQL server.

## Examples

```
$db->getServerVersion()
```

## Debug Errors

- No debug errors.

## Related Methods

[getDiagnostics](getDiagnostics.md) | [getHostInfo](getHostInfo.md) | [getProtocolVersion](getProtocolVersion.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Environment](../CoreyDB.md#environment)
