# compileWhere *[Protected]*

A specialized internal helper that isolates the logic for building the `WHERE` clause. It iterates through all stored conditional arrays, formats them with their respective logical operators (`AND`, `OR`), and wraps them into a clean string fragment.

> This method only constructs the query structure with placeholders (`?`). The actual values remain isolated to protect against SQL injection, later passing through the `bindings()` method.

## Usage

```
compileWhere(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns the compiled `WHERE` SQL conditional fragment.

## Examples

```
$db->compileWhere();
// Result: "WHERE `key` = 'value'"
```

## Debug Errors

- No debug errors.

## Related Methods

[where](where.md) | [compile](compile.md)| [compileLimit](compileLimit.md) | [compileOrder](compileOrder.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Compilers](../CoreyDB.md#compilers)
