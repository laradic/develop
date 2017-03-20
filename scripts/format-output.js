
/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://laradic.mit-license.org The MIT License
 */

const fs = require('fs');
const output = fs.readFileSync(__dirname + '/.curl-output', 'utf-8')
const pretty = require('util').inspect(JSON.parse(output), true, 5, true)
console.log(pretty)