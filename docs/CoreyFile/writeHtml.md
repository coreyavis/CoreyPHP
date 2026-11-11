# writeHtml

Creates or updates an HTML file within the configured directory path or target subfolder tree. It normalizes directory paths, automatically creates missing subdirectories, sanitizes the filename and markup content, and prevents overwriting existing files unless explicitly allowed.

## Usage

```
writeHtml(string $filename, ?string $code = null, bool $overwrite = false): bool
```

## Parameters

**filename** (string)
: The desired name or relative subfolder path of the HTML file (e.g., `index` or `folder/filename`). Leading dots and existing `.html` extensions are stripped from the filename portion while preserving parent folder path segments. Missing target subdirectories are created automatically. Falls back to a time-stamped filename (`file_{timestamp}.html`) if the filename portion is entirely invalid or empty.

**code** (string|null)
: The HTML markup content to write into the file. Defaults to an empty boilerplate if `null` or omitted. (*default*: `null`) *^(optional)^*

**overwrite** (bool)
: Whether to allow overwriting the file if it already exists. When set to `false`, attempting to write to an existing file will fail and trigger a warning. (*default*: `false`) *^(optional)^*

## Behavior and Process Flow

1. Path Separation: Normalizes directory separators and splits `$filename` into a folder path (`$dirPart`) and file identifier (`$filePart`).

2. Sanitization: Cleans `$filePart` against `FILENAMEREGEX` and strips leading dots and `.html` extensions.

3. Subdirectory Creation: Checks if `$dirPart` specifies a target subfolder (e.g., `blog/2026`). If the directory does not exist under `$baseDir`, it creates it recursively (`mkdir(..., 0755, true)`).

4. Encoding & Cleanup: Scrubs UTF-8 byte order marks, null bytes, normalizes line endings (`\n`), and scrubs invalid UTF-8 sequences.

5. Disk Write: Opens the target file in binary mode (`wb` or `xb`) and writes the sanitized HTML content.

## Return Value

(bool)
: Returns `true` if the file was successfully created or updated, or `false` if the target file already exists (when `$overwrite` is `false`) or cannot be created/opened.

## Examples

Creating a root template file:

```
$file->writeHtml('index');
// Result: index.html
```

Creating a file inside a nested subfolder tree:

```
$file->writeHtml('blog/2026/07', '<html><body><h1>July 2026 Archives</h1></body></html>');
// Result: blog/2026/07.html (creates blog/2026/ directory automatically)
```

Overwriting an existing HTML file:

```
$file->writeHtml('index', '<html><body><h1>Updated Home Page</h1></body></html>', true);
// Result: index.html is overwritten
```

## Debug Errors

- Triggers a warning if the target file already exists and `$overwrite` is set to `false`.
- Triggers a warning if the destination file could not be created or opened for writing due to permissions or path issues.

## Related Methods

[endCode](endCode.md) | [writeText](writeText.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
