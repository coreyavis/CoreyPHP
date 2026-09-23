# preview

This method serves as a diagnostic tool for inspecting the query before execution. It mirrors the compilation logic of the `execute` method to generate the final SQL string, including placeholders for bound parameters. Instead of interacting with the database, it returns the raw statement, allowing you to verify the structure and integrity of the query during development.

## Usage

```
preview(): string
```

## Parameters

- Takes no arguments.

## Return Value

(string)
: Returns the compiled SQL statement for the current query builder instance.

## Examples

```
$db->select()->where()->preview();
// Result: SELECT * FROM `table` WHERE 1
```

## Debug Errors

- Logs a notice if no table has been defined.

## Related Methods

[execute](execute.md) | [executeRaw](executeRaw.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Execution](../CoreyDB.md#execution)
