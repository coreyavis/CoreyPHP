# buildStaticAssetPath *[Protected]*

Transforms local static asset URLs (`<img>`, `<link>`, `<script>`) by prepending relative parent directory traversals (`../`) corresponding to the current page's subdirectory nesting depth.

> :pushpin: This method is protected and executed internally by `endCode()` when static HTML pages are output into subdirectories.

## Usage

```
buildStaticAssetPath(string $url, int $depth = 0): string
```

## Parameters

**url** (string)
: The raw asset URL or path extracted from an HTML element attribute (e.g., `assets/css/style.css` or `./images/logo.png`).

**depth** (integer)
: The directory depth count of the generated static HTML page (e.g., `0` for root `index.html`, `1` for `folder/filename.html`, `2` for `blog/2026/07.html`). (*default*: `0`) *^(optional)^*

## Behavior and Process Flow

1. Depth Check: Returns the URL unchanged if `$depth <= 0`.

2. External Link Bypass: Skips path modification if the URL is an absolute external protocol (`http://`, `https://`), protocol-relative link (`//`), inline data URI (`data:`), or absolute root path (`/`).

3. Path Normalization: Strips leading `./` indicators from the asset path.

4. Traversal Prepending: Prepends `../` repeated by `$depth` count to the normalized asset path (e.g., depth `1` transforms `assets/css/style.css` to `../assets/css/style.css`).

## Return Value

(string)
: Returns the transformed relative asset path containing the required directory traversals.

## Examples

```
// Depth 0 (Root page: index.html)
$path = $this->buildStaticAssetPath('assets/css/style.css', 0);
// Result: "assets/css/style.css"

// Depth 1 (Single subfolder: project/awesome.html)
$path = $this->buildStaticAssetPath('assets/css/style.css', 1);
// Result: "../assets/css/style.css"

// Depth 2 (Nested subfolders: blog/2026/07.html)
$path = $this->buildStaticAssetPath('images/photo.jpg', 2);
// Result: "../../images/photo.jpg"
```

## Debug Errors

- No debug errors.

## Related Methods

[buildStaticPath](buildStaticPath.md) | [endCode](endCode.md) | [processLocalAssets](processLocalAssets.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Helpers](../CoreyFile.md#helpers)
