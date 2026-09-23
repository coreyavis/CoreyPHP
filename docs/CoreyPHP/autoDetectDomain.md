# autoDetectDomain *[Protected]*

Automatically detects the current server hostname from incoming HTTP headers, sanitizes the host string, and formats it for cross-subdomain cookie and session security. Strips custom ports if present (e.g., `example.com:8080` -> `example.com`).

## Usage

```
autoDetectDomain(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns a normalized domain string prefixed with a wildcard dot (e.g., `".example.com"`) for valid HTTP web requests.
: Returns an empty string (`""`) for `localhost`, direct IP addresses, missing host headers, or local development environments where wildcard domain cookies are rejected by the web browsers.

## Examples

```
$cphp->autoDetectDomain();
// Result: .example.com
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| domain | '' (empty) | *string* | Domain name of website. If left empty the script will attempt to get the domain. |

## Debug Errors

- No debug errors.

## Related Methods

[setCookie](setCookie.md) | [startSession](startSession.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Helpers](../CoreyPHP.md#helpers)
