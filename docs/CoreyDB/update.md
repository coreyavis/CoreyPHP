# update

Defines the query type as a `UPDATE` statement. This method can be used to specify column names for a later `values()` call, or it can accept an associative array to define both columns and values at once.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
update(string ...$args): static
update(array $args): static
```

## Parameters

**args** (array|string)
: This parameter accepts three different formats:

- Variable List of Strings: Each string represents a column name.
- Indexed Array: An array of strings representing column names.
- Associative Array: An array where keys are column names and values are the data to be inserted. When using this format, the `values()` method is NOT required.

### Dynamic Value Tags

When passing values, you can use string tags (ex. `[datetime]`) to automatically inject dynamic system values. The class will parse these tags before executing the query.

| Tag | Keyword | Output Type | Description |
| --- | --- | --- | --- | --- |
| [date] | date | string | Current date formatted as `Y-m-d`. |
| [datetime] | datetime | string | Current date and time formatted as `Y-m-d H:i:s`. |
| [time] | time | string | Current time formatted as `H:i:s`. |
| [timestamp] | timestamp | integer | Current Unix timestamp. |

## Return Value

Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the `int` representing the number of affected rows.

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
- `where(...)` [[?]](.md): Filters query results by applying specific conditions to rows.
    - `andWhere(...)` [[?]](.md): Ensures both or multiple conditions must be true to include a row. Supports nested groups.
    - `orWhere(...)` [[?]](.md): Ensures at least one condition must be true to include a row. Supports nested groups.

## Examples

1. Standard Usage (Separate Keys and Values)

    Use this if you prefer to keep your column list and data separate.

```
$db->update('item', 'qty')->values('cars', 10)->where('user', 'name')->execute();
// Result: UPDATE `table` SET `item` = 'cars', `qty` = 10 WHERE 'user' = 'name'

$db->update('item', 'qty', 'modified')->values('cars', 10, '[datetime]')->where('user', 'name')->execute();
// Result: UPDATE `table` SET `item` = 'cars', `qty` = 10, `modified` = 'YYYY-MM-DD HH:MM:SS' WHERE 'user' = 'name' <- (YYYY-MM-DD HH:MM:SS = current date and time)
```

2. Associative Usage (Shorthand)

    Use this to define the entire payload in one go. The `values()` method is skipped entirely.

```
$db->update(['item' => 'cars', 'qty' => 20])->where('user', 'name')->execute();
// Result: UPDATE `table` SET `item` = 'cars', `qty` = 20 WHERE 'user' = 'name'

$db->update(['item' => 'cars', 'qty' => 20, 'modified' => '[datetime]'])->where('user', 'name')->execute();
// Result: UPDATE `table` SET `item` = 'cars', `qty` = 20, `modified` = 'YYYY-MM-DD HH:MM:SS' WHERE 'user' = 'name' <- (YYYY-MM-DD HH:MM:SS = current date and time)
```

## Debug Errors

- Throws an exception if the where clause is omitted.

## Related Methods

[delete](delete.md) | [insert](insert.md) | [replace](replace.md) | [select](select.md) | [show](show.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
