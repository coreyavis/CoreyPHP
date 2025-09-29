# getIP

Retrieves the local network IP address for the primary network interface.

## Usage

```
getIP(bool $long = false): string|int
```

## Parameters

**long** (bool)
: If set to `true`, IPv4 addresses will be returned as a long integer. *^(optional)^*

## Return Value

Returns IP address.

## Examples

```
$cphp->getIP() = 127.0.0.1
$cphp->getIP(true) = 2130706433
```

## Debug Errors

- No debug errors.

## Related Methods

[reservedIP](reservedIP.md) | [validIP](validIP.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [IP Operations](../CoreyPHP.md#ip-operations)
