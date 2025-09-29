# execute

This method acts as the terminal trigger for the query builder. It compiles the internal state into a valid SQL statement and dynamically routes the execution based on the presence of parameter bindings.

If no bindings exist, it bypasses the prepared statement layer entirely for maximum efficiency, making it fully compatible with database administration and utility commands like `SHOW`, `EXPLAIN`, and `DESCRIBE`. If bindings are present, it safely prepares the statement and binds parameters to guarantee SQL injection protection.

## Usage

```
execute(): mixed
```

## Parameters

- Takes no arguments.

## Return Value

Returns the result of the query depending on the SQL command executed and your configured output format:

- **`SELECT` / `SHOW`**: Returns the data set in your configured output format. (ex. array, json, object, serial, etc.). If the query returns zero rows, it safely maps to an appropriate empty representation based on that format (See: [formatData](formatData.md)).
- **`INSERT`**: Returns the `int` ID of the newly inserted row on success, or `true` if no ID is generated.
- **`UPDATE` / `DELETE` / `REPLACE`**: Returns an `int` representing the number of affected rows.

## Examples

```
$db->select()->where()->execute();
```

## Debug Errors

- Throws an exception if no table has been defined (unless running a raw `query()` or `show()` statement).
- Throws an exception if the compiled SQL string is empty.
- Throws an exception if there is an error with the bindings.
- Throws an exception if there is an unknown error with the execution.
- Triggers a warning if called before any query statements have been defined.

## Related Methods

[executeRaw](executeRaw.md) | [preview](preview.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Execution](../CoreyDB.md#execution)
