# CoreyPHP Static Site Generator

The **CoreyPHP Static Site Generator** is a built-in, lightweight PHP static site generator that compiles dynamic template files into production-ready static HTML while automatically managing asset pipelines and link structures.

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

## Related Methods

[startCode](CoreyFile/startCode.md) | [endCode](CoreyFile/endCode.md)

---
[Home](Home.md) | CoreyPHP Static Site Generator
