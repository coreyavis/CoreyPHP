# endCode

Finalizes the output buffer, transforms all internal `.php` links into nested static `.html` relative paths, ensures target directories exist, writes the resulting static HTML file if content changes are detected, and optionally delegates local asset extraction/copying.

> :pushpin: This method captures the rendered output since the `startCode()` method was executed.

## Usage

```
endCode(): bool
```

## Parameters

- Takes no arguments.

> :pushpin: This method automatically derives the target filename from the `$this->file` property which is automatically set with the current PHP file when class is instantiated.
>
> It maps the current script and `$_GET` state to a relative destination path (e.g., `blog.php?year=2026&month=07` -> `blog/2026/07.html`) and measures directory depth. Then it transforms links and rewrites all `href` and `action` attributes, automatically prepending relative directory traversals (`../`) based on depth.
>
> If `$this->outputPath` is specified, differs from `$this->path`, and the `copyAssets` config variable is set to true, `endCode()` automatically invokes `processLocalAssets()` to clone local CSS and image dependencies into the target build output directory before closing the output buffer.

## Return Value

(bool)
: Returns `true` if a static HTML file was newly generated or updated on disk, or `false` if the content remained unchanged (skipped file write) or if writing failed.

## Examples

```
$file->startCode();
// PHP and HTML code goes here...
$file->endCode();
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| copyAssets | true | *bool* | Copy local assets when using `endCode()`. |

### copyAssets

Determines whether local assets (such as images, stylesheets, and local linked resources) embedded in the generated HTML should be scanned and copied into the target output directory when generating static files.

Trigger Conditions: Local asset copying executes during `endCode()` only if all of the following conditions are met:

1. An output directory (`$this->outputPath`) is defined (`setOutputPath()`) and non-empty.

2. The target output path differs from the source path (`$this->path`).

3. The `copyAssets` configuration value evaluates strictly to `true`.

## Debug Errors

- No debug errors.

## Related Methods

[buildStaticPath](buildStaticPath.md) | [processLocalAssets](processLocalAssets.md) | [startCode](startCode.md) | [writeHtml](writeHtml.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Static Site Generator](../CoreyFile.md#static-site-generator)
