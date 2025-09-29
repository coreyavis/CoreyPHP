# isHttps *[Protected]*

Determines whether the current incoming HTTP request was made over an encrypted SSL/TLS (HTTPS) connection. Inspects direct server variables as well as common reverse-proxy and load-balancer headers.

## Usage

```
isHttps(): bool
```

## Parameters

- Takes no arguments.

## Return Value

Returns `true` if the request was served over HTTPS or terminated through an SSL reverse proxy.

Returns `false` if the request was served over plain, unencrypted HTTP (e.g., standard local development environments).

## Examples

```
$cphp->isHttps() = true|false
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Helpers](../CoreyPHP.md#helpers)
