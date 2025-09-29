# values

Maps and binds data payloads to your query components. This method is used in conjunction with structural statement methods (`insert`, `replace`, `update`) to supply row datasets, or with the `query` method to secure parameterized `?` placeholders against SQL injection.

> :pushpin: Dynamic Value Tags Supported: When passing elements to `values()`, you can utilize built-in string tags (e.g., [datetime]) to automatically resolve system metrics before query parsing.

## Usage

```
values(mixed ...$args): static
values(array $args): static
```

## Parameters

**args** (mixed)
: Data values to assign to the current query state. This parameter accepts two operational formats:

- Variable Argument List: A comma-separated sequence of literal values, variables, or dynamic tags.
- Indexed Array: A flat, sequentually indexed array containing the dataset payload.

| Tag | Keyword | Output Type | Description |
| --- | --- | --- | --- | --- |
| [date] | date | string | Current date formatted as `Y-m-d`. |
| [datetime] | datetime | string | Current date and time formatted as `Y-m-d H:i:s`. |
| [time] | time | string | Current time formatted as `H:i:s`. |
| [timestamp] | timestamp | integer | Current Unix timestamp. |

## Return Value

Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.

### Behavior by Operation Context

The exact role of `values()` shifts dynamically depending on the preceding method call in the chain:

| Preceding Method | Role of `values()` | Usage Necessity |
| --- | --- | --- |
| `insert(...)` | Maps row elements directly to the specified table columns. | **Optional**: Only required if columns were declared as standalone strings or an indexed array. Skipped if an associative array was passed to `insert()`. |
| `replace(...)` | Maps replacement row elements directly to the specified table keys. | **Optional**: Only required if keys were declared as standalone strings or an indexed array. Skipped if an associative array was passed to `replace()`. |
| `update(...)` | Assigns modification payloads to designated columns. | **Optional**: Only required if columns were declared as standalone strings or an indexed array. Skipped if an associative array was passed to `update()`. |
| `query(...)` | Securely binds data sequentially to all `?` placeholders in the raw SQL. | **Required**: If the SQL string contains `?` placeholders. |

## Examples

Structural Binding (`insert`, `replace`, `update`)

Used to feed data values into pre-defined column lists.

```
$db->insert('item', 'qty', 'created')->values('cars', 10, '[datetime]')->execute();
```

Parameterized Binding (`query`)

Used to sanitize inputs sequentially matching any `?` placeholders found in raw SQL strings.

```
$db->query("SELECT * FROM users WHERE status = ? AND login_count > ?")->values('active', 50)->execute();
```

## Debug Errors

- No debug errors.

## Related Methods

[insert](insert.md) | [query](query.md) | [replace](replace.md) | [update](update.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
