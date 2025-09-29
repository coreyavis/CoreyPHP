# validIP

Validates IPv4 and IPv6 addresses.

## Usage

```
validIP(string $ip, string &$version): bool
```

## Parameters

**ip** (string)
: IPv4 or IPv6 address to validate.

**version** (string)
: If version is populated, then it returns the detected IP standard (IPv4 or IPv6) upon successful validation. *^(optional)^*

## Return Value

Returns `true` on success and `false` on failure.

## Examples

```
$cphp->validIP('127.0.0.1') = true
$cphp->validIP('1.2.3') = false
$cphp->validIP('fd00::a:b:c:d') = true
$cphp->validIP('2001:db8:1:2:3:4:5') = false
```

### Output Examples

| IP address [^1] | Valid [^2] | $version [^3] |
| --- | :---: | :---: |
| 192.168.1.1 | true | IPv4 |
| fe80::1 | true | IPv6 |

[^1]: The supplied IP address
[^2]: `true` if valid, `false` if invalid
[^3]: The detected IP standard (IPv4 or IPv6)

## Debug Errors

- Logs a notice if IP address is empty.
- Logs a notice if invalid IP address format.

## Related Methods

[getIP](getIP.md) | [reservedIP](reservedIP.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [IP Operations](../CoreyPHP.md#ip-operations)
