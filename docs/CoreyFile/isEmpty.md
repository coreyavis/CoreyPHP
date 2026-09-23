# isEmpty

Checks whether a specified directory is empty. It automatically handles both absolute paths and relative paths (falling back to the configured base path), and normalizes cross-platform directory separators (`/` vs `\`).

## Usage

```
isEmpty(string $folder): bool
```

## Parameters

**folder** (string)
: The directory path to check. Can be an absolute path or a path relative to `$this->path`.

## Return Value

(bool)
: Returns `true` if the folder exists and contains no files or subdirectories.
: Returns `false` if the folder contains files/subdirectories, does not exist, or is unreadable due to permission issues.

> :pushpin: Since a standard empty directory contains `.` and `..`, a count of 2 or less subdirectories confirms the directory is empty.

## Examples

1. Checking a relative path

If your base path (`this->path`) is set to `/var/www/project/`, you can check a subfolder like this:

```
$file->isEmpty('src')
// Checks: /var/www/project/src/
```

2. Checking an absolute path

You can also pass a full system path directly, bypassing the base path check:

```
$file->isEmpty('/var/www/project/src/')
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Validation](../CoreyFile.md#validation)
