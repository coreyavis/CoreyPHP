# select

Defines the query type as a `SELECT` statement and specifies the columns to be retrieved.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
select(): static
select(array|string ...$columns): static
```

## Parameters

**columns** (array|string)
: A list of string column names, or an array containing column definitions. *^(optional)^*

- When providing strings or a sequential array: Items are treated as standard column names.
- When providing an associative array (`'column' => 'fallback'`): Wraps the column key in a `COALESCE(column, ?)` function and binds the fallback value.

> If no arguments are provided, then the `select` query will default to selecting all columns (`SELECT *`).

## Return Value

(static)
: Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the selected data from the database.

## Method Chaining

Before calling `execute()`, you can chain the following modifiers to customize your results:

- `between(...)` [[?]](between.md): Filters data within an inclusive range.
- `in(...)` [[?]](in.md): Filters data that matches any value in a specified list.
    - `notIn(...)` [[?]](notIn.md): Filters data that excludes everything in a specified list
- `like(...)` [[?]](like.md): Filters data by matching a specific text pattern using wildcards.
- `limit(...)` [[?]](limit.md): Limit number of affected rows.
- `offset(...)` [[?]](offset.md): Limit offset.
- `order(...)` [[?]](order.md): Defines the sort order.
    - `orderByValue(...)` [[?]](orderByValue.md): Prioritizes rows by value.
    - `asc(...)` [[?]](asc.md): Sort in ascending order.
    - `desc(...)` [[?]](desc.md): Sort in descending order.
- `output(...)` [[?]](output.md): Defines the structure of the output data (e.g., Array, JSON, Object, Serial).
- `where(...)` [[?]](.md): Filters query results by applying specific conditions to rows.
    - `andWhere(...)` [[?]](.md): Ensures both or multiple conditions must be true to include a row. Supports nested groups.
    - `orWhere(...)` [[?]](.md): Ensures at least one condition must be true to include a row. Supports nested groups.

## Examples

Default (No arguments)

```
$db->select()->where()->execute();
// Result: SELECT * FROM `table` WHERE 1
```

String Arguments (Sequential)

```
$db->select('item', 'qty')->where()->execute();
// Result: SELECT `item`, `qty` FROM `table` WHERE 1
```

Sequential Array Argument

```
$db->select(['item', 'qty'])->where()->execute();
// Result: SELECT `item`, `qty` FROM `table` WHERE 1
```

Associative Array Argument (COALESCE)

```
$db->select(['item', 'qty' => 'No value'])->where()->execute();
// Result: SELECT `item`, COALESCE(`qty`, ?) FROM `table` WHERE 1
// Bindings: ['No value']
```

## Debug Errors

- No debug errors.

## Related Methods

[delete](delete.md) | [insert](insert.md) | [replace](replace.md) | [show](show.md) | [update](update.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
