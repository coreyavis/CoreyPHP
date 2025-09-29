# getHostInfo

Returns a string representing the connection type and server host being utilized.

> :pushpin: This information is also automatically collected and included in the global report returned by [getDiagnostics()](getDiagnostics.md).

## Usage

```
getHostInfo(): string
```

## Parameters

- Takes no arguments.

## Return Value

Returns the string representing the connection type and server host being utilized.

## Examples

```
$db->getHostInfo()
```

## Debug Errors

- No debug errors.

## Related Methods

[getDiagnostics](getDiagnostics.md) | [getProtocolVersion](getProtocolVersion.md) | [getServerVersion](getServerVersion.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Environment](../CoreyDB.md#environment)
