# getFileMetadata

Retrieves a formatted array of metadata for the current active file. This method parses the file path and converts raw system values (like byte sizes and Unix timestamps) into human-readable and database-ready formats.

## Usage

```
getFileMetadata(): array
```

## Parameters

- Takes no arguments.

## Return Value

(array)
: Returns an associative array containing the file's structural details and formatted metrics.

| Key | Type | Description |
| --- | --- | --- |
| filename | string | The name of the active file. |
| size | string | The file size, converted into a human-readable format. |
| created | string | The file creation time, formatted as a SQL-compliant timestamp. |
| modified | string | The last modification time, formatted as a SQL-compliant timestamp. |
| accessed | string | The last accessed time, formatted as a SQL-compliant timestamp. |
| path | string | The absolute directory path where the file is located. |
| ext | string | The file extension (e.g., `txt`, `json`, `php`) |

## Examples

```
$metadata = $file->filename('file.txt')->getFileMetadata();
// Result: Array
(
    [filename] => file.txt
    [size] => 1.5 MB
    [created] => 0000-00-00 00:00:00
    [modified] => 0000-00-00 00:00:00
    [accessed] => 0000-00-00 00:00:00
    [path] => /var/www/project/storage
    [ext] txt
)
```

## Debug Errors

- No debug errors.

## Related Methods

[getDiagnostics](getDiagnostics.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)
