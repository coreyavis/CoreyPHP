# resolveDomain *[Protected]*

Resolves the active target domain string used across session cookie parameters and general HTTP cookies. Prioritizes explicit configuration options over dynamic server header auto-detection.

## Usage

```
resolveDomain(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns the trimmed, normalized domain string from configuration if set, or uses `autoDetectDomain()` to detect the domain if no explicit domain configuration exists.

> :pushpin: If the configured domain begins with `www.`, it returns a wildcard-prefixed domain string (e.g., `".example.com"`).

## Examples

```
$cphp->resolveDomain();
// Result: .example.com
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| domain | '' (empty) | *string* | Domain name of website. If left empty the script will attempt to get the domain. |

## Debug Errors

- No debug errors.

## Related Methods

[autoDetectDomain](autoDetectDomain.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Helpers](../CoreyPHP.md#helpers)
