# setCookie

Sets an HTTP cookie with strict security defaults, automated serialization, and flexible, additive configurable retention periods.

## Usage

```
setCookie(string $key, mixed $value): bool
```

## Parameters

**key** (string)
: The cookie identifier name.

**value** (mixed)
: The value to store. If an array is passed, it is automatically serialized to a JSON string.

> :pushpin: Cookie expiration is calculated by summing all time units defined in the `cookie.lifetime` configuration array (months, weeks, days, hours, minutes).
>
> If the calculated duration is 0 or unconfigured, it defaults to 1 day (86,400 seconds). Final retention is bounded between a minimum of 1 minute and a maximum of 1 year.
>
> Path is standardized to `'/'` (available site-wide).
>
> Domain is resolved dynamically using `resolveDomain()`.

## Return Value

Returns `true` if cookie headers were successfully sent to the browser, `false` otherwise.

## Examples

Store a basic string cookie:

```
$cphp->setCookie('theme', 'dark');
```

Store a complex array (automatically converted to JSON):

```
$cphp->setCookie('preferences', ['notifications' => true, 'sidebar' => 'collapsed']);
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| cookie.lifetime.months | 0 | *integer* &ge; 0 | Retention months (calculated as 30 days per month). |
| cookie.lifetime.weeks | 0 | *integer* &ge; 0 | Retention weeks (calculated as 7 days per week). |
| cookie.lifetime.days | 30 | *integer* &ge; 0 | Retention days. |
| cookie.lifetime.hours | 0 | *integer* &ge; 0 | Retention hours. |
| cookie.lifetime.minutes | 0 | *integer* &ge; 0 | Retention minutes. |
| NOTE: Lifetime configurations are additive. For example, setting `days => 1` and `hours => 12` results in a total lifetime of 36 hours. ||||
| domain | '' (empty) | *string* | Domain name of website. If left empty the script will attempt to get the domain. |

## Debug Errors

- No debug errors.

## Related Methods

[getCookie](getCookie.md) | [removeCookie](removeCookie.md)

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Cookie Management](../CoreyPHP.md#cookie-management)
