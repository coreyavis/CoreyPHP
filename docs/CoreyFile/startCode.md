# startCode

Initializes output buffering at the top of a PHP script. This begins capturing all generated HTML markup so it can be transformed and written to a static `.html` file by `endCode()`.

> :pushpin: Must be called before any HTML markup, whitespace, or output is rendered by the PHP script to ensure the entire page is captured.

## Usage

```
startCode(): bool
```

## Parameters

- Takes no arguments.

## Return Value

(bool)
: Returns `true` if output buffering was successfully started, or `false` on failure.

## Examples

```
$file->startCode();
// PHP and HTML code goes here...
$file->endCode();
```

## Debug Errors

- No debug errors.

## Related Methods

[endCode](endCode.md) | [writeHtml](writeHtml.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Static Site Generator](../CoreyFile.md#static-site-generator)
