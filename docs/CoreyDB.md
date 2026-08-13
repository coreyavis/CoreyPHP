# Database Management

The CoreyDB class simplifies MySQL interactions with clean, intuitive syntax for database management.

## Table of Contents

1. [Usage](#usage)
2. [Parameters](#parameters)
3. [Public Methods](#public-methods)
    - [Environment](#environment)
    - [Structure](#structure)
    - [Modifiers](#modifiers)
    - [Operations](#operations)
    - [Execution](#execution)
    - [Output](#output)
    - [Utilities](#utilities)
    - [Validation](#validation)
4. [Internal Methods](#internal-methods)
    - [Inspectors](#inspectors)
    - [Compilers](#compilers)
    - [Helpers](#helpers)
5. [Public Properties](#public-properties)
6. [Configuration Options](#configuration-options)
    
## Usage

```
$db = new CoreyDB(array $userConfig);
```

## Parameters

**userConfig**
: An array of initial configuration options which seamlessly merges into the master `CoreyPHP` configuration array; alternatively, use setConfig() to update these values later.

## Public Methods

### Environment

The following methods manage the database environment, handling connection establishment, and connectivity diagnostics.

- [dbConnection](CoreyDB/dbConnection.md) - Database connection
- [dbSelect](CoreyDB/dbSelect.md) - Database selection
- [getDiagnostics](CoreyDB/getDiagnostics.md) - Server environment and metrics
    - [getHostInfo](CoreyDB/getHostInfo.md) - Host info
    - [getProtocolVersion](CoreyDB/getProtocolVersion.md) - Protocol version
    - [getServerVersion](CoreyDB/getServerVersion.md) - Server version

### Structure

The following methods facilitate schema discovery and providing tools to inspect the database structure.

- [getLastQuery](CoreyDB/getLastQuery.md) - Last query executed
- [getTable](CoreyDB/getTable.md) - Get active table
    - [setTable](CoreyDB/setTable.md) - Set active table
- [listColumns](CoreyDB/listColumns.md) - List table columns
- [listDatabases](CoreyDB/listDatabases.md) - List server databases
- [listTables](CoreyDB/listTables.md) - List database tables

### Modifiers

The following methods are used to refine query criteria and constrain result sets.

- [between](CoreyDB/between.md) - Between query modifier
- [filter](CoreyDB/filter.md) - Data results filter
- [in](CoreyDB/in.md) - In query modifier
    - [notIn](CoreyDB/notIn.md) - Not In query modifier
- [like](CoreyDB/like.md) - Like query modifier
- [limit](CoreyDB/limit.md) - Limit query modifier
    - [offset](CoreyDB/offset.md) - Limit Offset query modifier
- [order](CoreyDB/order.md) - Order By query modifier
    - [orderByValue](CoreyDB/orderByValue.md) - Order By Value query modifier
    - [asc](CoreyDB/asc.md) - Order By Ascending
    - [desc](CoreyDB/desc.md) - Order By Descending
- [where](CoreyDB/where.md) - Where query modifier
    - [andWhere](CoreyDB/andWhere.md) - And Where query modifier
    - [orWhere](CoreyDB/orWhere.md) - Or Where query modifier

### Operations

The following methods are the primary database actions, such as data retrieval, record creation, and updates, to establish the intent of the query.

- [delete](CoreyDB/delete.md) - Delete statement
- [insert](CoreyDB/insert.md) - Insert statement
- [query](CoreyDB/query.md) - Query statement
- [replace](CoreyDB/replace.md) - Replace statement
- [select](CoreyDB/select.md) - Select statement
    - [selectAs](CoreyDB/selectAs.md) - Select As statement
- [show](CoreyDB/show.md) - Show statement
- [update](CoreyDB/update.md) - Update statement
- [values](CoreyDB/values.md) - Optional values method

### Execution

The following methods handle the final execution phase of the query lifecycle and compile all previously defined structures and modifiers into a prepared statement.

- [execute](CoreyDB/execute.md) - Execute SQL query
    - [executeRaw](CoreyDB/executeRaw.md) - Execute Raw SQL query
- [preview](CoreyDB/preview.md) - Preview SQL query

### Output

The following methods manage result set hydration and data extraction, allowing you to retrieve query results in various formats.

- [output](CoreyDB/output.md) - Data output

### Utilities

The following methods are support utilities for handling common system tasks which assist in the broader application logic.

- [parseTag](CoreyDB/parseTag.md) - Tag parser
- [sqlEscape](CoreyDB/sqlEscape.md) - SQL escape
- [sqlWrap](CoreyDB/sqlWrap.md) - SQL wrapper

### Validation

The following methods provide type-checking utilities to verify data integrity, ensuring that inputs conform to expected formats.

- [isValidOperator](CoreyDB/isValidOperator.md) - Validate valid query operator
- [isValidOutput](CoreyDB/isValidOutput.md) - Validate output type

## Internal Methods

The following methods are either **private** or **protected**. They are documented here for developers who wish to extend this class.

### Inspectors

- [checkConnection](CoreyDB/checkConnection.md) - Check database connection
- [databaseExists](CoreyDB/databaseExists.md) - Verify database exists
- [tableExists](CoreyDB/tableExists.md) - Verify table exists in database
- [columnExists](CoreyDB/columnExists.md) - Verify column exists in table

### Compilers

- [compile](CoreyDB/compile.md) - Query compiler
    - [compileLimit](CoreyDB/compileLimit.md) - Limit modifier compiler
    - [compileOrder](CoreyDB/compileOrder.md) - Order By modifier compiler
    - [compileWhere](CoreyDB/compileWhere.md) - Where modifier compiler

### Helpers

- [bindings](CoreyDB/bindings.md) - Binding types string generator
- [formatData](CoreyDB/formatData.md) - Format data
- [getValidOperator](CoreyDB/getValidOperator.md) - Get valid query operator
- [getValidOutput](CoreyDB/getValidOutput.md) - Get valid output type
- [normalizeWhere](CoreyDB/normalizeWhere.md) - Normalize Where modifier
- [resetState](CoreyDB/resetState.md) - Reset query builder
- [searchStr](CoreyDB/searchStr.md) - Search string generator
- [whereGroup](CoreyDB/whereGroup.md) - Where group modifier
- [whereStr](CoreyDB/whereStr.md) - Where string generator

## Public Properties

| Variable | Description | Example |
| --- | --- | --- |
| insertId | The read-only insert ID of a newly inserted row using the `insert` or `replace` methods. | `$db->insertId` |

## Configuration Options

Refer to the [Configuration Documentation](Config.md#coreydb) section for a complete overview.

---
[Home](Home.md) | CoreyDB
