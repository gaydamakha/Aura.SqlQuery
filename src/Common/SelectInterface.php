<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/mit-license.php MIT
 *
 */

namespace Aura\SqlQuery\Common;

use Aura\SqlQuery\QueryInterface;
use Exception;

/**
 *
 * An interface for SELECT queries.
 *
 * @package Aura.SqlQuery
 *
 */
interface SelectInterface extends QueryInterface, WhereInterface, OrderByInterface, LimitOffsetInterface
{
    /**
     *
     * Sets the number of rows per page.
     *
     * @param int $paging The number of rows to page at.
     *
     * @return $this
     *
     */
    public function setPaging($paging);

    /**
     *
     * Gets the number of rows per page.
     *
     * @return int The number of rows per page.
     *
     */
    public function getPaging();

    /**
     *
     * Makes the select FOR UPDATE (or not).
     *
     * @param bool $enable Whether or not the SELECT is FOR UPDATE (default
     * true).
     *
     * @return $this
     *
     */
    public function forUpdate(bool $enable = true): SelectInterface;

    /**
     *
     * Makes the select DISTINCT (or not).
     *
     * @param bool $enable Whether or not the SELECT is DISTINCT (default
     * true).
     *
     * @return $this
     *
     */
    public function distinct(bool $enable = true): SelectInterface;

    /**
     *
     * Is the select DISTINCT?
     *
     * @return bool
     *
     */
    public function isDistinct(): bool;

    /**
     *
     * Adds columns to the query.
     *
     * Multiple calls to cols() will append to the list of columns, not
     * overwrite the previous columns.
     *
     * @param array $cols The column(s) to add to the query.
     *
     * @return $this
     *
     */
    public function cols(array $cols): SelectInterface;

    /**
     *
     * Remove a column via its alias.
     *
     * @param string $alias The column to remove
     *
     * @return bool
     *
     */
    public function removeCol(string $alias): bool;

    /**
     *
     * Has the column or alias been added to the query?
     *
     * @param string $alias The column or alias to look for
     *
     * @return bool
     *
     */
    public function hasCol(string $alias): bool;

    /**
     *
     * Does the query have any columns in it?
     *
     * @return bool
     *
     */
    public function hasCols(): bool;

    /**
     *
     * Returns a list of columns.
     *
     * @return array
     *
     */
    public function getCols(): array;

    /**
     *
     * Adds a FROM element to the query; quotes the table name automatically.
     *
     * @param string $spec The table specification; "foo" or "foo AS bar".
     *
     * @return $this
     *
     */
    public function from(string $spec): SelectInterface;

    /**
     *
     * Adds a raw unquoted FROM element to the query; useful for adding FROM
     * elements that are functions.
     *
     * @param string $spec The table specification, e.g. "function_name()".
     *
     * @return $this
     *
     */
    public function fromRaw(string $spec): SelectInterface;

    /**
     *
     * Adds an aliased sub-select to the query.
     *
     * @param string|Select $spec If a Select object, use as the sub-select;
     * if a string, the sub-select string.
     *
     * @param string $name The alias name for the sub-select.
     *
     * @return $this
     *
     */
    public function fromSubSelect($spec, string $name): SelectInterface;

    /**
     *
     * Adds a JOIN table and columns to the query.
     *
     * @param string $join The join type: inner, left, natural, etc.
     *
     * @param string $spec The table specification; "foo" or "foo AS bar".
     *
     * @param string|null $cond Join on this condition.
     *
     * @return $this
     *
     */
    public function join(string $join, string $spec, ?string $cond = null): SelectInterface;

    /**
     *
     * Adds a INNER JOIN table and columns to the query.
     *
     * @param string $spec The table specification; "foo" or "foo AS bar".
     *
     * @param string|null $cond Join on this condition.
     *
     * @param array $bind Values to bind to ?-placeholders in the condition.
     *
     * @return $this
     *
     * @throws Exception
     */
    public function innerJoin(string $spec, ?string $cond = null, array $bind = array()): SelectInterface;

    /**
     *
     * Adds a LEFT JOIN table and columns to the query.
     *
     * @param string $spec The table specification; "foo" or "foo AS bar".
     *
     * @param string|null $cond Join on this condition.
     *
     * @param array $bind Values to bind to ?-placeholders in the condition.
     *
     * @return $this
     *
     * @throws Exception
     *
     */
    public function leftJoin(string $spec, ?string $cond = null, array $bind = array()): SelectInterface;

    /**
     *
     * Adds a JOIN to an aliased subselect and columns to the query.
     *
     * @param string $join The join type: inner, left, natural, etc.
     *
     * @param string|Select $spec If a Select
     * object, use as the sub-select; if a string, the sub-select
     * command string.
     *
     * @param string $name The alias name for the sub-select.
     *
     * @param string|null $cond Join on this condition.
     *
     * @return $this
     *
     */
    public function joinSubSelect(string $join, $spec, string $name, ?string $cond = null): SelectInterface;

    /**
     *
     * Adds grouping to the query.
     *
     * @param array $spec The column(s) to group by.
     *
     * @return $this
     *
     */
    public function groupBy(array $spec): SelectInterface;

    /**
     *
     * Adds a HAVING condition to the query by AND.
     *
     * @param string|callable(SelectInterface):SelectInterface $cond The HAVING condition.
     *
     * @param array $bind Values to be bound to placeholders.
     *
     * @return $this
     *
     */
    public function having($cond, array $bind = []): SelectInterface;

    /**
     *
     * Adds a HAVING condition to the query by OR.
     *
     * @param string|callable(SelectInterface):SelectInterface $cond The HAVING condition.
     *
     * @param array $bind Values to be bound to placeholders.
     *
     * @return $this
     *
     * @see having()
     *
     */
    public function orHaving($cond, array $bind = []): SelectInterface;

    /**
     *
     * Sets the limit and count by page number.
     *
     * @param int $page Limit results to this page number.
     *
     * @return $this
     *
     */
    public function page(int $page): SelectInterface;

    /**
     *
     * Returns the page number being selected.
     *
     * @return int
     *
     */
    public function getPage(): int;

    /**
     *
     * Takes the current select properties and retains them, then sets
     * UNION for the next set of properties.
     *
     * @return $this
     *
     */
    public function union(): SelectInterface;

    /**
     *
     * Takes the current select properties and retains them, then sets
     * UNION ALL for the next set of properties.
     *
     * @return $this
     *
     */
    public function unionAll(): SelectInterface;

    /**
     *
     * Clears the current select properties, usually called after a union.
     * You may need to call resetUnions() if you have used one
     *
     * @return void
     */
    public function reset(): void;

    /**
     *
     * Resets the columns on the SELECT.
     *
     * @return $this
     *
     */
    public function resetCols(): SelectInterface;

    /**
     *
     * Resets the FROM and JOIN clauses on the SELECT.
     *
     * @return $this
     *
     */
    public function resetTables(): SelectInterface;

    /**
     *
     * Resets the WHERE clause on the SELECT.
     *
     * @return $this
     *
     */
    public function resetWhere(): SelectInterface;

    /**
     *
     * Resets the GROUP BY clause on the SELECT.
     *
     * @return $this
     *
     */
    public function resetGroupBy(): SelectInterface;

    /**
     *
     * Resets the HAVING clause on the SELECT.
     *
     * @return $this
     *
     */
    public function resetHaving(): SelectInterface;

    /**
     *
     * Resets the ORDER BY clause on the SELECT.
     *
     * @return $this
     *
     */
    public function resetOrderBy(): SelectInterface;

    /**
     *
     * Resets the UNION and UNION ALL clauses on the SELECT.
     *
     * @return $this
     *
     */
    public function resetUnions(): SelectInterface;
}
