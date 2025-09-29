# filename

Sets the active file for the class instance and automatically hydrates its metadata (size, path, and timestamps).

> :pushpin: Default Behavior: When the class is initialized for the first time, it defaults to the file from which it was instantiated. Use this method to explicitly switch to a different file within the active directory path or a target path.

## Usage

```
filename(string $filename): static
```

## Parameters

**filename** (string)
: The name of the file or path to target. Leading and trailing whitespaces are automatically trimmed.

## Return Value

Returns the current instance to allow for method chaining.

### Metadata

When this method is successfully called, it updates the following internal class properties:

- `$this->file`: The resolved basename of the target file (e.g., `index.php`).
- `$this->bytes`: Raw file size in bytes (`int`).
- `$this->size`: The converted human-readable file size string.
- `$this->created`: Formatted creation date string.
- `$this->modified`: Formatted modification date string.
- `$this->accessed`: Formatted access date string.
- `$this->path`: The normalized absolute directory path containing the target file (ends with a trailing slash `/`).

## Examples

```
$file->filename('file.txt')
```

## Debug Errors

- Throws an exception if `$filename` is empty.
- Throws an exception if the file does not exist.
- Throws an exception if the path points to a directory instead of a file.

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)
