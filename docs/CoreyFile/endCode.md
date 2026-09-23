# endCode

Finalizes the output buffer, transforms all internal `.php` links into nested static `.html` relative paths, ensures target directories exist, and writes the resulting static HTML file if content changes are detected.

> :pushpin: This method captures the rendered output since the `startCode()` method was executed.

## Usage

```
endCode(): bool
```

## Parameters

- Takes no arguments.

> :pushpin: This method automatically derives the target filename from the `$this->file` property which is automatically set with the current PHP file when class is instantiated.
>
> It maps current script and `$_GET` state to a relative destination path (e.g., `blog.php?year=2026&month=07` -> `blog/2026/07.html`) and measures directory depth. Then it transforms links and rewrites all `href` and `action` attributes, automatically prepending relative directory traversals (`../`) based on depth.
>
> The method will create subdirectories to build required folder trees without requiring recursive native flags.

## Return Value

(bool)
: Returns `true` if a static HTML file was newly generated or updated on disk, or `false` if the content remained unchanged (skipped file write) or if writing failed.

## Examples

```
$file->startCode();
// PHP and HTML code goes here...
$file->endCode();
```

## Debug Errors

- No debug errors.

## Related Methods

[buildStaticPath](buildStaticPath.md) | [startCode](startCode.md) | [writeHtml](writeHtml.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Static Site Generator](../CoreyFile.md#static-site-generator)
