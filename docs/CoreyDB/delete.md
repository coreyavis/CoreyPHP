# delete

Defines the query type as a `DELETE` statement. The column and value for an equality `where` statement can be defined within this method or you can use the `where` method.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
delete(): static
delete(?string $column = null, mixed $value = null): static
```

## Parameters

**column** (?string)
: The column (or field) within the database. *^(optional)^*

**value** (mixed)
: The value of the column. *^(optional)^*

## Return Value

(static)
: Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the `int` representing the number of affected rows.

## Method Chaining

Before calling `execute()`, you can chain the following modifiers to customize your results:

- `between(...)` [[?]](between.md): Filters data within an inclusive range.
- `in(...)` [[?]](in.md): Filters data that matches any value in a specified list.
    - `notIn(...)` [[?]](notIn.md): Filters data that excludes everything in a specified list
- `like(...)` [[?]](like.md): Filters data by matching a specific text pattern using wildcards.
- `where(...)` [[?]](.md): Filters query results by applying specific conditions to rows.
    - `andWhere(...)` [[?]](.md): Ensures both or multiple conditions must be true to include a row. Supports nested groups.
    - `orWhere(...)` [[?]](.md): Ensures at least one condition must be true to include a row. Supports nested groups.

## Examples

```
$db->delete('id', 12)->execute();
// Result: DELETE FROM `table` WHERE `id` = 12

$db->delete()->where('user', 'name')->execute();
// Result: DELETE FROM `table` WHERE `user` = 'name'
```

## Debug Errors

- Throws an exception if the where clause is omitted.
- Logs a warning if only one argument is provided.

## Related Methods

[insert](insert.md) | [replace](replace.md) | [select](select.md) | [show](show.md) | [update](update.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
