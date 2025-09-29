# Formulas and Equations

The CoreyFX class encapsulates a variety of utility methods, organized into categories such as Array Management, Data Conversion, Date and Time Processing, Mathematical, and Validation.

## Table of Contents

1. [Usage](#usage)
2. [Parameters](#parameters)
3. [Public Methods](#public-methods)
    - [Array Management](#array-management)
    - [Date & Time Processing](#date-and-time-processing)
    - [Financial](#financial)
    - [Formulas](#formulas)
    - [Mathematical](#mathematical)
    - [Validation](#validation)
4. [Configuration Options](#configuration-options)
    
## Usage

```
$fx = new CoreyFX(array $userConfig);
```

## Parameters

**userConfig**
: An array of initial configuration options which seamlessly merges into the master `CoreyPHP` configuration array; alternatively, use setConfig() to update these values later.

## Public Methods

### Array Management

The following methods are used for array management and manipulation.

- [flipArray](CoreyFX/flipArray.md) - Flip array

### Date and Time Processing

The following methods are used to generate and manipulate date and time variables.

- [emailTimestamp](CoreyFX/emailTimestamp.md) - Email timestamp generator
- [formatDuration](CoreyFX/formatDuration.md) - Calculates date/time difference
- [makeTimestamp](CoreyFX/makeTimestamp.md) - Generate a custom Unix timestamp
- [showDate](CoreyFX/showDate.md) - Formats timestamp into date
- [showDatetime](CoreyFX/showDatetime.md) - Formats timestamp into date and time
- [showTime](CoreyFX/showTime.md) - Formats timestamp into time
- [sqlDate](CoreyFX/sqlDate.md) - SQL date generator
- [sqlTime](CoreyFX/sqlTime.md) - SQL time generator
- [sqlTimestamp](CoreyFX/sqlTimestamp.md) - SQL timestamp generator
- [timecode](CoreyFX/timecode.md) - Timecode generator
- [timecodeConvert](CoreyFX/timecodeConvert.md) - Timecode converter to seconds
- [timeConvert](CoreyFX/timeConvert.md) - Time converter to seconds
- [timer](CoreyFX/timer.md) - Timer with laps
- [timestamp](CoreyFX/timestamp.md) - Unix timestamp generator
- [timeString](CoreyFX/timeString.md) - Seconds or timecode converter to time string
- [timeSum](CoreyFX/timeSum.md) - Sum/Add time values

### Financial

The following methods process financial calculations.

- [interest](CoreyFX/interest.md) - Calculates credit card interest

### Formulas

The following methods perform specialized calculations.

- [kmh](CoreyFX/kmh.md) - Kilometers per hour
- [mph](CoreyFX/mph.md) - Miles per hour

### Mathematical

The following methods are a collection of common mathematical functions.

- [average](CoreyFX/average.md) - Average calculator
- [diff](CoreyFX/diff.md) - Difference/Subtraction calculator
- [factors](CoreyFX/factors.md) - Factors calculator
- [gcd](CoreyFX/gcd.md) - Greatest Common Divisor
- [lcm](CoreyFX/lcm.md) - Least Common Multiple
- [mean](CoreyFX/mean.md) - Mean calculator
- [median](CoreyFX/median.md) - Median calculator
- [midrange](CoreyFX/midrange.md) - Midrange calculator
- [mod](CoreyFX/mod.md) - Mod calculator
- [mode](CoreyFX/mode.md) - Mode calculator
- [product](CoreyFX/product.md) - Product/Multiplication calculator
- [quotient](CoreyFX/quotient.md) - Quotient/Division calculator
- [spread](CoreyFX/spread.md) - Difference between minimum and maximum
- [sum](CoreyFX/sum.md) - Sum/Addition calculator

### Validation

The following methods validate data formats and types.

- [isDecimal](CoreyFX/isDecimal.md) - Validate if string contains decimals
- [isEmail](CoreyFX/isEmail.md) - Validates if string is valid email address
- [isPhone](CoreyFX/isPhone.md) - Validates if string is valid phone number
- [isSqlTimestamp](CoreyFX/isSqlTimestamp.md) - Validates valid SQL timestamp
- [isTimecode](CoreyFX/isTimecode.md) - Validates valid timecode

## Configuration Options

Refer to the [Configuration Documentation](Config.md#coreyfx) section for a complete overview.

---
[Home](Home.md) | CoreyFX
