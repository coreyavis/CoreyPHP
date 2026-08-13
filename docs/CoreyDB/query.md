# query

Initializes a customizable SQL query chain. Unlike immediate execution methods, `query` allows you to chain various modifiers, such as binding parameters, filtering results, and defining the output type, before finally triggering the database call with the `execute` method.

> :pushpin: **Execution Required**: This method only constructs the SQL statement. You must terminate the method chain with `->execute()` to actually run the query against the database or `->preview()` to view the sql code.

## Usage

```
query(string $sql): static
```

## Parameters

**sql** (string)
: The SQL statement structure to be prepared and modified. Can include `?` placeholders for parameterized data binding.

## Return Value

Returns the current instance to allow for method chaining.

> NOTE: This method does not execute the query immediately. You must chain the `execute()` method at the end of your chain to run the query against the database.
>
> Upon successful execution, the `execute()` method returns the corresponding data depending on the type of statement you executed.

## Method Chaining

Before calling `execute()`, you can chain the following modifiers to customize your results:

- `values(...)`: Binds values sequentially to any `?` placeholders defined in the SQL string to protect against SQL injection.
- `filter(...)` [[?]](filter.md): Filters the returned dataset based on specified conditions.
- `output(...)` [[?]](output.md): Defines the structure of the output data (e.g., Array, JSON, Object, Serial).

## Examples

Basic Query

```
$db->query("SELECT * FROM users WHERE status = 'active'")->execute();
```

Formatted Output

```
$db->query("SELECT * FROM users WHERE status = 'active'")->output('json')->execute();
```

Parameterized Query (Secure Data Binding)

```
$db->query("SELECT * FROM users WHERE status = ?")->values('active')->execute();
```

## Comparison: `query` vs. `executeRaw`

While both methods allow you to write custom, direct SQL statements, they serve entirely different workflows:

| Feature | `query()` | `executeRaw()` |
| --- | --- | --- |
| Execution Timing | Deferred. Only executes when `->execute()` is called. | Immediate. Executes the moment the method is called. |
| Parameter Binding | Supported. Chain `->values` to safely map variables to `?` placeholders. | Not supported natively via chaining. Variables must be pre-sanitized. |
| Method Chaining | Supported. Allows modifiers like `->values`, `->filter()` and `->output()`. | Not supported. No chaining allowed. |
| Primary Use Case | Building complex, secure, and flexible data retrieval queries. | Running system-level commands, migrations, or quick raw fetches. |
| Return Value | Returns a chainable object instance. | Returns the raw dataset (read) or a boolean (write). |

## Debug Errors

- Throws an exception if the provided SQL syntax is invalid upon execution.
- Throws an exception if the number of arguments passed to `values()` does not match the number of `?` placeholders defined in the `query()` string.

## Related Methods

[executeRaw](executeRaw.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Operations](../CoreyDB.md#operations)
