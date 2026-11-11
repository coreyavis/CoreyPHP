# Changelog

All notable changes to this project will be documented in this file.

## [1.0.3] - 2026-11-11
### Fixed

* Fixed endCode() and writeHtml() to support nested subdirectories and relative asset paths
* Fixed Commit Sync for Documentation

### Updated

* Updated: writeText() to support nested subdirectories
* Updated: Documentation and StaticSiteGenerator guide

## [1.0.2] - 2026-11-10
### Added

* Added: Recursive manifest/JSON inspection
* Added: Internal and Inline CSS asset copying.

### Fixed

* Fixed: Documentation
* Fixed: Improved file detection using stack validation
* Fixed: Initialize $db as a nullable mysqli property

### Updated

* Updated: Automated local asset copying and optimization

## [1.0.1] - 2026-11-10
### Added

* Added: Local asset copying
* Added: Recursive folder creation
* Added: copyFile method and documentation

### Updated

* Updated: CoreyFile class and documentation

## [1.0.0] - 2026-11-10
### Added

* Initial release of the project on [GitHub](https://github.com)
* Core functionality and basic setup.
* **MySQL Database Wrapper:** Created a streamlined database class to simplify interactions. Includes methods for selecting, updating, and displaying data seamlessly.
* **Security Suite:** Built a comprehensive security class featuring secure hashing tools, salt generation, password generation, entropy calculation, and a password strength evaluation tool.
* **File Management:** Developed an automation class to manage local file systems and file operations easily.
* **Utility Classes:** Introduced core helper modules containing dedicated classes for validation, type conversion, mathematical calculations, and date/time manipulation.

