# filter

Filters the final result set of a query to only include specified columns. While compatible with both `SELECT` and `SHOW` queries, this method is primarily designed to act as a post-processor for `SHOW` statements (e.g., `SHOW COLUMNS`), providing a workaround for MySQL's lack of native `WHERE` or column-filtering clauses in `SHOW` syntax.

> :pushpin: This filter is applied after the data has been retrieved from the MySQL server. It operates entirely in PHP memory.

## Usage

```
filter(array|string ...$filters): static
```

## Parameters

**filters** (array|string)
: A list or array of column name(s) you want to retain in the final output. If a single column filter is provided, the final output is automatically flattened into a simple one-dimensional array unless the output type is associative (ex. `->filter('Field')->output('assoc')`).

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$columns = $db->show('columns')->filter('Field')->execute();
$columns = $db->show('columns')->filter('Field', 'Type')->execute();
$columns = $db->show('columns')->filter(['Field', 'Extra'])->execute();
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)
