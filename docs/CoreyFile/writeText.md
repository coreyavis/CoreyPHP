# writeText

Creates or updates a text file within the configured directory path or target subfolder tree. It normalizes directory paths, automatically creates missing subdirectories, sanitizes the filename and content, handles cross-platform line endings, and prevents overwriting existing files unless explicitly allowed.

## Usage

```
writeText(string $filename, string $text = '', bool $overwrite = false): bool
```

## Parameters

**filename** (string)
: The desired name or relative subfolder path of the text file (e.g., `notes` or `logs/2026/debug`). Leading dots and existing `.txt` extensions are stripped from the filename portion while preserving parent folder path segments. Missing target subdirectories are created automatically. Falls back to a time-stamped filename (`file_{timestamp}.txt`) if the filename portion is entirely invalid or empty.

**text** (string)
: The text content to process and write to the file. (*default*: `''`) *^(optional)^*

**overwrite** (bool)
: Whether to allow overwriting the file if it already exists. When set to `false`, attempting to write to an existing file will fail and trigger a warning. (*default*: `false`) *^(optional)^*

## Behavior and Process Flow

1. Path Separation: Normalizes directory separators and splits `$filename` into a folder path (`$dirPart`) and file identifier (`$filePart`).

2. Sanitization: Cleans `$filePart` against `FILENAMEREGEX` and strips leading dots and `.txt` extensions.

3. Subdirectory Creation: Checks if `$dirPart` specifies a target subfolder (e.g., `logs/2026`). If the directory does not exist under `$baseDir`, it creates it recursively (`mkdir(..., 0755, true)`).

4. Encoding & Cleanup: Scrubs UTF-8 byte order marks, null bytes, normalizes line endings (`\n`), scrubs invalid UTF-8 sequences, and strips trailing whitespace.

5. Disk Write: Opens the target file in binary mode (`wb` or `xb`) and writes the sanitized text content.

## Return Value

(bool)
: Returns `true` if the file was successfully created or updated, or `false` if the target file already exists (when `$overwrite` is `false`) or cannot be created/opened.

## Examples

Creating a root text file:

```
$file->writeText('welcome', 'Hello World!');
// Result: welcome.txt
```

Creating a text file inside a nested subfolder tree:

```
$file->writeText('logs/2026/debug', 'System initialized successfully.');
// Result: Result: logs/2026/debug.txt (creates logs/2026/ directory automatically)
```

Overwriting an existing text file:

```
$file->writeText('welcome', 'Hello great big World!', true);
// Result: welcome.txt is overwritten
```

## Debug Errors

- Triggers a warning if the target file already exists and `$overwrite` is set to `false`.
- Triggers a warning if the destination file could not be created or opened for writing due to permissions or path issues.

## Related Methods

[writeHtml](writeHtml.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
