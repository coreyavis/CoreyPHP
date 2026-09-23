# writeHtml

Creates or updates an HTML file within the configured directory path. It safely normalizes the file name, sanitizes the markup content, and prevents overwriting existing files unless explicitly allowed.

## Usage

```
writeHtml(string $filename, ?string $code = null, bool $overwrite = false): bool
```

## Parameters

**filename** (string)
: The desired name of the HTML file. Path components, leading dots, and existing extensions are automatically stripped, ensuring the file is safely created inside the designated directory with a `.html` extension. Falls back to a time-stamped filename (`file_{timestamp}.html`) if the input name is entirely invalid or empty.

**code** (string|null)
: The HTML markup content to write into the file. Defaults to an empty boilerplate if `null` or omitted. (*default*: `null`) *^(optional)^*

**overwrite** (bool)
: Whether to allow overwriting the file if it already exists. When set to `false`, attempting to write to an existing file will fail and trigger a warning. (*default*: `false`) *^(optional)^*

## Return Value

(bool)
: Returns `true` if the file was successfully created or updated, or `false` if the target file already exists (when `$overwrite` is `false`) or cannot be created/opened.

## Examples

Creating an empty template file:

```
$file->writeHtml('index');
// Result: index.html
```

Creating a file with custom markup:

```
$file->writeHtml('about', '<html><body><h1>About me</h1></body></html>');
// Result: about.html
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

[writeText](writeText.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
