# copyFile

Copies a file from the managed path directory to a target location (either within the same directory or a sub/external path). Automatically handles missing folder creation and avoids filename collisions using timestamp suffixes.

## Usage

```
copyFile(string $filename, string $destPath = ''): bool
```

## Parameters

**filename** (string)
: The name or path of the source file located within `$this->path`.

**destPath** (string)
: Optional target directory path. Accepts relative paths (e.g., `folder/subfolder`) or absolute paths (e.g., `/var/www/uploads`). (*default*: `''`) *^(optional)^*

## Return Value

(bool)
: Returns `true` if the file was copied successfully, or `false` on failure or permission/validation error.

> :pushpin: Same-Directory Copy: Always appends a timestamp suffix in the format `YYYY-MM-DD_HHMM`.
>
> Different-Directory Copy: Keeps the original name unless a file with that name already exists, in which case it appends the timestamp suffix.
>
> Same-Minute Multi-Copy: Appends an incremental index (`_1`, `_2`, etc.) if multiple copies are created within the exact same minute.

## Examples

1. Copy a file within the same directory

```
// Original file: /var/www/uploads/report.pdf
$file->copyFile('report.pdf');
// Result: /var/www/uploads/report_YYYY-MM-DD_HHMM.pdf
```

2. Copy a file to a relative subfolder

```
$file->copyFile('report.pdf', 'archive');
// Result: /var/www/uploads/archive/report.pdf
```

3. Copy a file to an absolute path

```
$file->copyFile('report.pdf', '/var/www/backups/');
// Result: /var/www/backups/report.pdf
```

## Debug Errors

- Throws an exception if file does not exist or access is restricted.
- Throws an exception if the target is not a file but a directory.
- Throws an exception if file is not readable.
- Throws an exception if the destination directory does not exist and the method is unable to create it.
- Throws an exception if the destination directory is not writable.
- Throws an exception if the file fails to copy.

## Related Methods

[removeFile](removeFile.md) | [renameFile](renameFile.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Structure](../CoreyFile.md#structure)
