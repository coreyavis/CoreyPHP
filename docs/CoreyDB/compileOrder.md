# compileOrder *[Protected]*

A specialized internal helper that isolates the logic for building the `ORDER BY` clause.

## Usage

```
compileOrder(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns the compiled `ORDER BY` SQL conditional fragment.

## Examples

```
$db->compileOrder();
// Result: 'ORDER BY `key`'
```

## Debug Errors

- No debug errors.

## Related Methods

[order](order.md) | [orderByValue](orderByValue.md) | [asc](asc.md) | [desc](desc.md) | [compile](compile.md) | [compileLimit](compileLimit.md) | [compileWhere](compileWhere.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Compilers](../CoreyDB.md#compilers)
