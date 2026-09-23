# writeText

Creates or updates a text file within the configured base path. This method sanitizes both the filename and content, handles cross-platform encoding and newline issues, and ensures files are created automatically without overwriting existing files unless explicitly allowed.

## Usage

```
writeText(string $filename, string $text = '', bool $overwrite = false): bool
```

## Parameters

**filename** (string)
: The desired name or path for the file. Any directories, leading dots, or existing extensions will be stripped, and `.txt` will be appended. Falls back to a time-stamped filename (`file_{timestamp}.txt`) if the input name is entirely invalid or empty.

**text** (string)
: The text content to process and write to the file. (*default*: `''`) *^(optional)^*

**overwrite** (bool)
: Whether to allow overwriting the file if it already exists. When set to `false`, attempting to write to an existing file will fail and trigger a warning. (*default*: `false`) *^(optional)^*

## Return Value

(bool)
: Returns `true` if the file was successfully created or updated, or `false` if the target file already exists (when `$overwrite` is `false`) or cannot be created/opened.

## Examples

Creating a file:

```
$file->writeText('welcome', 'Hello World!');
// Result: welcome.txt
```

Overwriting an existing text file:

```
$file->writeText('welcome', 'Hello great big World!');
// Result: welcome.txt is overwritten
```

## Debug Errors

- Triggers a warning if the target file already exists and `$overwrite` is set to `false`.
- Triggers a warning if the destination file could not be created or opened for writing due to permissions or path issues.

## Related Methods

[writeHtml](writeHtml.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
