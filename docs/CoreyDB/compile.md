# compile *[Protected]*

Acts as the main orchestrator for query building. It aggregates and sequences all individual query fragments (`SELECT`, `JOIN`, `WHERE`, `ORDER BY`, `LIMIT`, etc.) into a single, valid SQL string ready for execution.

## Usage

```
compile(): string
```

## Parameters

- Takes no arguments.

## Return Value

Returns the fully constructed SQL statement.

## Examples

```
$db->compile();
// Result: 'SQL query'
```

## Debug Errors

- Throws an exception if the where clause is omitted in the `DELETE` and `UPDATE` statements.
- Triggers a warning if called before any query statements have been defined.

## Related Methods

[compileLimit](compileLimit.md) | [compileOrder](compileOrder.md) | [compileWhere](compileWhere.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Compilers](../CoreyDB.md#compilers)
