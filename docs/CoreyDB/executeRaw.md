# executeRaw

Executes a direct SQL query against the database without parameter binding. Returns a result set for read operations or a boolean for write operations. Use this for system-level commands and non-parameterized queries.

> :pushpin: Unlike the query builder methods, `executeRaw` triggers the database call immediately. Do not chain an `execute` method at the end of this call.

## Usage

```
executeRaw(string $sql): mixed
```

## Parameters

**sql** (string)
: The SQL statement to run against the database.

## Return Value

(mixed)
: Returns a dataset on success for select-type queries, or `true` on success and `false` on failure.

## Examples

```
$db->executeRaw('SELECT @@default_storage_engine AS engine');
```

## Comparison: `executeRaw` vs. `query`

While both methods allow you to pass custom SQL strings, they handle execution and data manipulation differently.

- `executeRaw()`: Designed for fast, immediate execution. It cannot be chained with modifiers and bypasses the internal query builder entirely. Ideal for system-level operations.
- `query()`: Designed for deferred execution. It starts a chain that allows you to attach modifiers like `filter()` and `output()` to format your data, requiring a final `execute()` call to trigger the database.

## Debug Errors

- Throws an exception if there is an error with the execution.

## Related Methods

[query](query.md) | [execute](execute.md) | [preview](preview.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Execution](../CoreyDB.md#execution)
