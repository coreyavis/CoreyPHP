# processAndCopyAsset *[Private]*

Recursively validates, normalizes, optimizes, and copies individual assets into the output directory, with automatic recursive inspection and path resolution for CSS stylesheets, Webmanifests, and JSON files.

> :pushpin: This method is private and executed internally by `processLocalAssets()`.

## Usage

```
processAndCopyAsset(string $url, string $path, string $outputPath, string $parentSubDir = ''): void
```

## Parameters

**url** (string)
: The asset URL or path extracted from HTML or CSS content.

**path** (string)
: The directory path (`$this->path`).

**outputPath** (string)
: The target output directory path (`$this->outputPath`).

**parentSubDir** (string)
: The relative subdirectory of the parent file (CSS or JSON/Webmanifest) if called recursively. (*default*: `''`) *^(optional)^*

## Behavior & Process Flow

1. Filtering: Skips external protocols (`http://`, `https://`), protocol-relative links (`//`), data URIs (`data:`), and patterns matching `self::EXTSRCREGEX`.

2. Relative Path Resolution: Resolves asset paths relative to CSS directories or project roots using `resolveRelativePath()`.

3. Directory Recreation: Automatically creates missing target subdirectories inside `$outputPath`.

4. Timestamp Optimization: Compares source and destination modification times (`filemtime`). Skips copying if the destination file is already up to date.

5. Recursive CSS Inspection: If the copied file is a `.css` stylesheet, it reads the file contents, extracts any nested url(...) assets, and recursively calls `processAndCopyAsset()` for font and background image dependencies.

6. Recursive Manifest/JSON Inspection: If the copied file is a `.webmanifest` or `.json` file, parses the JSON structure and recursively extracts and copies any referenced asset paths found under keys such as `"src"` or `"url"` (e.g., app icons and screenshots).

## Return Value

(void)
: This method does not return a value.

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| copyAssets | true | *bool* | Copy local assets when using [endCode()](CoreyFile/endCode.md#copyAssets). |

## Debug Errors

- No debug errors.

## Related Methods

[endCode](endCode.md) | [processLocalAssets](processLocalAssets.md) | [resolveRelativePath](resolveRelativePath.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Helpers](../CoreyFile.md#helpers)
