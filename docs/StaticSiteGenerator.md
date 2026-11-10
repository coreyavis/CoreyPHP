# CoreyPHP Static Site Generator

The **CoreyPHP Static Site Generator** is a built-in, lightweight PHP static site generator that compiles dynamic template files into production-ready static HTML while automatically managing asset pipelines and link structures.

## Features

- The generator automatically derives the target filename from the `$this->file` property which is automatically set with the current PHP file when class is instantiated.

- It maps the current script and `$_GET` state to a relative destination path (e.g., `blog.php?year=2026&month=07` -> `blog/2026/07.html`) and measures directory depth. Then it transforms links and rewrites all `href` and `action` attributes, automatically prepending relative directory traversals (`../`) based on depth.

- If `$this->outputPath` is specified, differs from `$this->path`, and the `copyAssets` config variable is set to true, `endCode()` automatically invokes `processLocalAssets()` to clone local CSS and image dependencies into the target build output directory before closing the output buffer.

## Key Capabilities

- **Smart Link Transformation:** Automatically converts dynamic `.php` links and query strings into nested static `.html` relative paths (handling directory depth and `../` traversals automatically).
- **Automated Asset Synchronization:** When `copyAssets` is enabled, the generator scans your compiled output for local dependencies and mirrors them to your build directory, including:
  - Images (`<img>`, inline CSS `url(...)`)
  - Stylesheets (`<link rel="stylesheet">`)
  - JavaScript files (`<script src="...">`)
  - Configuration files & app icons (`site.webmanifest` and `.json` icons)
- **Recursive Dependency Resolution:** Automatically inspects external CSS stylesheets and web manifests to resolve relative paths and pull in nested background images, fonts, and icon assets.
- **Timestamp Optimization:** Compares source and destination file modification times (`filemtime`) to skip unchanged assets, keeping build times lightning-fast.
- **Incremental & Change Detection:** Uses MD5 content hashing to prevent redundant disk writes when static HTML output remains unchanged.

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| copyAssets | true | *bool* | Copy local assets when using `endCode()`. |

### copyAssets

Determines whether local assets (such as images, stylesheets, and local linked resources) embedded in the generated HTML should be scanned and copied into the target output directory when generating static files.

Trigger Conditions: Local asset copying executes during `endCode()` only if all of the following conditions are met:

1. An output directory (`$this->outputPath`) is defined (`setOutputPath()`) and non-empty.

2. The target output path differs from the source path (`$this->path`).

3. The `copyAssets` configuration value evaluates strictly to `true`.

## Related Methods

[startCode](CoreyFile/startCode.md) | [endCode](CoreyFile/endCode.md)

---
[Home](Home.md) | CoreyPHP Static Site Generator
