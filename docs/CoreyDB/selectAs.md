# selectAs

Defines the query type as a `SELECT` statement using an alias (`AS`), with optional string concatenation utilizing `CONCAT()` or `CONCAT_WS()`.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
selectAs(string $column, string $as, string ...$concat): static
```

## Parameters

**column** (string)
: The primary column name or value to be selected or used as the starting point for concatenation.

**as** (string)
: The alias name given to the selected column or concatenated result.

**concat** (string)
: Additional column names or literal string values to concatenate with the primary $column. *^(optional)^*

> If `$concat` is provided, the method automatically merges `$column` and `$concat` into an array, identifies valid column names to backtick wrap, treats invalid column names as raw string variables, and compiles them into a SQL concatenation function.
>
> - If the `glue` configuration is empty, it compiles using `CONCAT()`.
> - If the `glue` configuration is populated, it compiles using `CONCAT_WS()` using the configured glue value as the separator. (Default glue: ' ' (*space*))

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

Standard Alias (No concatenation)

```
$db->selectAs('user_id', 'id')->execute();
// Result: SELECT `user_id` AS `id` FROM `table`
```

With Concatenation (When `glue` is empty: `''` or `null`)

```
$db->setConfig('glue', null);
$db->selectAs('Qty: ', 'qty', 'quantity')->execute();
// Result: SELECT CONCAT('Qty: ', `quantity`) AS `qty` FROM `table`
// qty = Qty: quantity

$db->selectAs('first_name', 'full_name', ' ', 'last_name')->execute();
// Result: SELECT CONCAT(`first_name`, ' ', `last_name`) AS `full_name` FROM `table`
// full_name = first_name last_name
```

With Concatenation (When `glue` is active)

```
$db->selectAs('first_name', 'full_name', 'last_name')->execute();
// Result: SELECT CONCAT_WS(' ', `first_name`, `last_name`) AS `full_name` FROM `table`
// full_name = first_name last_name

$db->setConfig('glue', ', ');
$db->selectAs('last_name', 'full_name', 'first_name')->execute();
// Result: SELECT CONCAT_WS(', ', `last_name`, `first_name`) AS `full_name` FROM `table`
// full_name = last_name, first_name
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| glue | ' ' (*space*) | *string* | The separator used for string concatenation. |
| NOTE: If set to an empty string or null, the method falls back to a standard `CONCAT()` ||||

## Debug Errors

- No debug errors.

## Related Methods

[select](select.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
