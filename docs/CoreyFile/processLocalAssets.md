# processLocalAssets *[Private]*

Parses HTML content for local image (`<img>`) and stylesheet (`<link>`) assets, resolves their paths relative to the source directory, recreates subfolder directory structures, and copies missing asset files into the output directory. 

:pushpin: This method is private and executes internally by `endCode()` when static asset copying is enabled.

## Usage

```
processLocalAssets(string $htmlContent): void
```

## Parameters

**htmlContent** (string)
: The fully transformed HTML string generated during the buffer process.

## Behavior & Process Flow

1. Asset Extraction: Matches local asset references using `self::IMGSRCREGEX` (image sources) and `self::LINKHREFREGEX` (stylesheet links).

2. Filtering External Links: Filters out external protocol links (`http://`, `https://`), protocol-relative paths (`//`), inline data URIs (`data:`), and patterns matching `self::EXTSRCREGEX`.

3. Path Normalization: Strips query strings, removes relative directory indicators (`./` and `../`), and resolves local source file paths against `$this->path`.

4. Directory Structure Preservation: Recreates the exact original directory structure (e.g., `assets/images/`, `assets/css/`) inside `$this->outputPath`.

5. File Transfer: Copies files from source to destination if they do not already exist in the output directory.

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

[endCode](endCode.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Helpers](../CoreyFile.md#helpers)
