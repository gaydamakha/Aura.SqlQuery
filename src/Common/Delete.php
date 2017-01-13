<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\SqlQuery\Common;

use Aura\SqlQuery\AbstractDmlQuery;

/**
 *
 * An object for DELETE queries.
 *
 * @package Aura.SqlQuery
 *
 */
class Delete extends AbstractDmlQuery implements DeleteInterface
{
    use WhereTrait;

    /**
     *
     * The table to delete from.
     *
     * @var string
     *
     */
    protected $from;

    /**
     *
     * Sets the table to delete from.
     *
     * @param string $table The table to delete from.
     *
     * @return $this
     *
     */
    public function from($table)
    {
        $this->from = $this->quoter->quoteName($table);
        return $this;
    }

    /**
     *
     * Builds this query object into a string.
     *
     * @return string
     *
     */
    protected function build()
    {
        return 'DELETE'
            . $this->buildFlags()
            . $this->buildFrom()
            . $this->buildWhere()
            . $this->buildOrderBy()
            . $this->buildLimit()
            . $this->buildReturning();
    }

    /**
     *
     * Builds the FROM clause.
     *
     * @return string
     *
     */
    protected function buildFrom()
    {
        return " FROM {$this->from}";
    }

    /**
     *
     * Template method overridden for queries that allow LIMIT and OFFSET.
     *
     * Builds the `LIMIT ... OFFSET` clause of the statement.
     *
     * Note that this will allow OFFSET values with a LIMIT.
     *
     * @return string
     *
     */
    protected function buildLimit()
    {
        return '';
    }
}
