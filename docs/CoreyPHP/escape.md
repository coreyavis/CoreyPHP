# escape *[Protected]*

Encodes special characters into their corresponding HTML entities. This method performs HTML Output Encoding to prevent Cross-Site Scripting (XSS) attacks when rendering dynamic data or user input into HTML views.

## Usage

```
method(mixed $value): string
```

## Parameters

**value** (mixed)
: The data value to escape. Will be explicitly cast to a `string`.

## Return Value

(string)
: Returns the UTF-8 safe, HTML-encoded string representation of the input.

## Examples

```
$cphp->escape('<script>alert("XSS")</script>');
// Result: &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyPHP](../CoreyPHP.md) | [Helpers](../CoreyPHP.md#helpers)
