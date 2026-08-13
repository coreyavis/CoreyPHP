# getFiles

Retrieves only the files within a specified directory. It can optionally return detailed metadata arrays for each file, including extension, converted human-readable file size, creation, modification, and access timestamps, as well as permissions.

> :pushpin: This method normalizes file paths into standardized URLs (`file://`) using a configured directory separator. It automatically filters out directories, dot directories (`.` and `..`), and symlinks.

## Usage

```
getFiles(?string $directory = null, bool $details = false, bool $perms = false): array|bool
```

## Parameters

**directory** (string)
: The directory path to scan. If `null`, defaults to the directory where the script initially ran. *^(optional)^*

> If no `$directory` argument is supplied, the method automatically targets `$this->path`, running the scan on the initialization directory where the script first executed.

**details** (bool)
: If set to `true`, returns a multidimensional array containing detailed metadata for each file. If set to `false`, returns a flat array of file names. (*default*: `false`) *^(optional)^*

**perms** (bool)
: If set to `true` (and `$details` is `true`), includes converted octal permission string in the metadata. (*default*: `false`) *^(optional)^*

## Return Value

Returns an array containing only the found files (either as string names or metadata arrays).

Returns `false` if the directory does not exist or cannot be parsed by either the main iterator or the fallback handler.

### Public Properties

Upon a successful scan, this method automatically updates the following public properties on the object:

- **`$files`** (int) - The total number of files discovered. Defaults to `0` if the scan fails.

## Examples

1. Basic Structure (`$details = false`)

Returns a simple list of folder names.

```
$file->getFiles($directory)
// Result: 
[
    'index.php',
    'README.md'
]
```

2. Detailed Structure (`$details = true`, `$perms = true`)

Returns descriptive associative arrays for each file found.

```
$file->getFiles($directory, true, true)
// Result:
[
    [
        'file'      => 'index.php',
        'path'      => '/var/www/project/index.php',
        'ext'       => 'php',
        'size'      => '14.2 KB',
        'created'   => 'MM/DD/YYYY MM:SS AM|PM',
        'modified'  => 'MM/DD/YYYY MM:SS AM|PM',
        'accessed'  => 'MM/DD/YYYY MM:SS AM|PM',
        'perms'     => '0644'
    ],
    [
        'file'      => 'README.md',
        'path'      => '/var/www/project/README.md',
        'ext'       => 'md',
        'size'      => '2.5 KB',
        'created'   => 'MM/DD/YYYY MM:SS AM|PM',
        'modified'  => 'MM/DD/YYYY MM:SS AM|PM',
        'accessed'  => 'MM/DD/YYYY MM:SS AM|PM',
        'perms'     => '0644'
    ]
]
```

## Debug Errors

- Triggers a warning if the target directory does not exist or if the fallback reader fails to open the stream.

## Related Methods

[getDirectory](getDirectory.md) | [getFolders](getFolders.md)

---
[Home](../Home.md) | [CoreyFile](../CoreyFile.md) | [Environment](../CoreyFile.md#environment)
