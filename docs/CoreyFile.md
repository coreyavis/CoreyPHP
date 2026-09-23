# File Management

The CoreyFile class provides a robust, object-oriented interface for interacting with the server's filesystem. It abstracts standard PHP file functions into an intuitive API for reading, writing, editing, and retrieving metadata from files.

## Table of Contents

1. [Usage](#usage)
2. [Parameters](#parameters)
3. [Public Methods](#public-methods)
    - [Environment](#environment)
    - [Structure](#structure)
    - [Conversion](#conversion)
    - [Date and Time](#date-and-time)
    - [Image Generation](#image-generation)
    - [Static Site Generator](#static-site-generator)
    - [Validation](#validation)
    - [Version Control](#version-control)
4. [Internal Methods](#internal-methods)
    - [Helpers](#helpers)
5. [Public Properties](#public-properties)
6. [Configuration Options](#configuration-options)
    
## Usage

```
$file = new CoreyFile(array $userConfig);
```

## Parameters

**userConfig**
: An array of initial configuration options which seamlessly merges into the master `CoreyPHP` configuration array; alternatively, use setConfig() to update these values later.

## Public Methods

### Environment

The following methods are responsible for managing the state, metadata, and operations of the files and folders you interact with.

- [filename](CoreyFile/filename.md) - Sets the active file
- [getDiagnostics](CoreyFile/getDiagnostics.md) - Environment and metrics
- [getDirectory](CoreyFile/getDirectory.md) - Get a directory list
- [getFileMetadata](CoreyFile/getFileMetadata.md) - Active file metadata
- [getFiles](CoreyFile/getFiles.md) - Get a list of files
- [getFolders](CoreyFile/getFolders.md) - Get a list of folders
- [getParents](CoreyFile/getParents.md) - Get a list of parent directories
- [setPath](CoreyFile/setPath.md) - Set new path for file management
    - [setOutputPath](CoreyFile/setOutputPath.md) - Set output path for file generation methods

### Structure

The following methods are responsible for creating, editing, and modifying files and folders.

- [addFolder](CoreyFile/addFolder.md) - Creates a folder
    - [removeFolder](CoreyFile/removeFolder.md) - Removes a folder
    - [renameFolder](CoreyFile/renameFolder.md) - Renames a folder
- [copyFile](CoreyFile/copyFile.md) - Copies a file
    - [removeFile](CoreyFile/removeFile.md) - Remove a file
    - [renameFile](CoreyFile/renameFile.md) - Rename a file
- [writeHtml](CoreyFile/writeHtml.md) - Creates a HTML file
- [writeText](CoreyFile/writeText.md) - Creates a text file

### Conversion

The following methods facilitate format conversion.

- [convertToBytes](CoreyFile/convertToBytes.md) - Converts a human-readable file size string to bytes
- [filesizeConvert](CoreyFile/filesizeConvert.md) - Converts a file size in bytes to a human-readable format
- [permsConvert](CoreyFile/permsConvert.md) - Converts a decimal file permission integer

### Date and Time

The following methods are used to generate and manipulate date and time variables.

- [fileDate](CoreyFile/fileDate.md) - Formats a Unix timestamp to a human-readable date format

### Image Generation

The following methods are used to create images using the [CoreyPHP Color Code Utility System](ColorCodes.md).

- [createJpg](CoreyFile/createJpg.md) - Create JPG image file using CoreyPHP color code
- [createPng](CoreyFile/createPng.md) - Create PNG image file using CoreyPHP color code

### Static Site Generator

- [startCode](CoreyFile/startCode.md) - Initializes output buffer
- [endCode](CoreyFile/endCode.md) - Captures the buffered output and writes to file

### Validation

The following methods provide type-checking utilities to verify data integrity, ensuring that inputs conform to expected formats.

- [isEmpty](CoreyFile/isEmpty.md) - Checks if folder is empty

### Version Control

The following methods help to generate standardized version strings for software releases, continuous integration build identifiers, and nightly builds.

- [nightlyBuild](CoreyFile/nightlyBuild.md) - Calculates a nightly build version
- [versionByDate](CoreyFile/versionByDate.md) - Generates a standard calendar version
- [versionByTime](CoreyFile/versionByTime.md) - Generates a granular, build-level version

## Internal Methods

The following methods are either **private** or **protected**. They are documented here for developers who wish to extend this class.

### Helpers

- [buildStaticPath](CoreyFile/buildStaticPath.md) - Creates nested static HTML relative directory paths

## Public Properties

| Variable | Description | Example |
| --- | --- | --- |
| file | The trimmed filename. | `$file->file` |
| bytes | The file size in bytes | `$file->bytes` |
| size | The file size converted. | `$file->size` |
| created | Date file was created. | `$file->created` |
| modified | Date file was last modified. | `$file->modified` |
| accessed | Date file was last accessed. | `$file->accessed` |
| path | The absolute directory path of the current working directory. | `$file->path` |

## Configuration Options

Refer to the [Configuration Documentation](Config.md#coreyfile) section for a complete overview.

---
[Home](Home.md) | CoreyFile
