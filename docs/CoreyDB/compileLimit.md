# compileLimit *[Protected]*

A specialized internal helper that isolates the logic for building the `LIMIT` clause.

## Usage

```
compileLimit(): string
```

## Parameters

- Takes no arguments.

## Return Value

Returns the compiled `LIMIT` SQL conditional fragment.

## Examples

```
$db->compileLimit();
// Result: 'LIMIT 10' or 'LIMIT 10 OFFSET 10'
```

## Debug Errors

- Throws an exception if an order() statement has not been included.

## Related Methods

[limit](limit.md) | [compile](compile.md)| [compileOrder](compileOrder.md) | [compileWhere](compileWhere.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Compilers](../CoreyDB.md#compilers)
