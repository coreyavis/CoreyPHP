# reservedIP

Validates whether an IPv4 or IPv6 address falls within a reserved range (e.g., private, multicast, or loopback).

## Usage

```
reservedIP(string $ip): bool
```

## Parameters

**ip** (string)
: IPv4 or IPv6 address to validate.

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

## Examples

```
$cphp->reservedIP('192.168.1.1') = true
$cphp->reservedIP('1.1.1.1') = false
$cphp->reservedIP('fd00::a:b:c:d') = true
$cphp->reservedIP('2001:db8:85a3::8a2e:370:7334') = false
```

## Debug Errors

- Logs a notice if IP address is empty.

## Related Methods

[getIP](getIP.md) | [validIP](validIP.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [IP Operations](../CoreyPHP.md#ip-operations)
