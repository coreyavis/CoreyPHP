# Error Handling Documentation

This documentation will help you to better understand how errors are handled within the CoreyPHP library.

## Table of Contents

1. [Error Handling Strategy](#error-handling-strategy)
2. [Public Error Management Methods](#public-error-management-methods)
3. [Internal Error Dispatching](#internal-error-dispatching)
4. [Custom Error Views](#custom-error-views)

## Error Handling Strategy

The CoreyPHP library uses an adaptive, environment-aware error reporting pipeline. Depending on your configuaration settings and PHP `ini` environment values, the library intelligently chooses between throwing exceptions, triggering native user-level errors, or safely formatting debugging dumps.

## Public Error Management Methods

These are the public-facing methods you can use to explicitly route caught errors or pass system logs through the CoreyPHP formatting engines.

- [errorMsg](CoreyPHP/errorMsg.md)
- [exceptionMsg](CoreyPHP/exceptionMsg.md)

## Internal Error Dispatching

- [error](CoreyPHP/error.md)

## Custom Error Views

When an unexpected exception slips past your custom app logic and is processed directly by `exceptionMsg()`, CoreyPHP outputs a clean developer block containing critical data points:

- Error Title: Labeled prominently as CoreyPHP Exception.
- File metadata: Explicit line references tracking the origin.
- Stack Trace: A boxed preformatted trace dump highlighting execution steps.

> NOTE: In production environments, ensure `debug` is turned off and `display_errors` is set to `0` in your php.ini settings to prevent leaking these detailed code views to users.

---
[Home](Home.md) | Error Handling
