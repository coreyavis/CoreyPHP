# processLocalAssets *[Private]*

Parses HTML content for local assets (including images, stylesheets, scripts, and inline CSS `url(...)` references), filters out external links and data URIs, and delegates asset processing and copying to `processAndCopyAsset()`.

:pushpin: This method is private and executes internally by `endCode()` when static asset copying is enabled.

## Usage

```
processLocalAssets(string $htmlContent): void
```

## Parameters

**htmlContent** (string)
: The fully transformed HTML string generated during the buffer process.

## Behavior & Process Flow

1. Asset Extraction: Matches local references across multiple tags and formats:

	- Image sources (`IMGSRCREGEX`)
	- Stylesheet/link hrefs (`LINKHREFREGEX`)
	- Script sources (`<script src="...">`)
	- Inline CSS declarations (`url(...)`)

2. Delegation: Passes each discovered unique asset URL to `processAndCopyAsset()` for path resolution, optimization check, and transfer.

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

[endCode](endCode.md) | [processAndCopyAsset](processAndCopyAsset.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Helpers](../CoreyFile.md#helpers)
