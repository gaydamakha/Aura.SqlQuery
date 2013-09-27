<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @package Aura.Sql
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Sql_Query\Mysql;

use Aura\Sql_Query\Traits;

/**
 *
 * An object for MySQL INSERT queries.
 *
 * @package Aura.Sql
 *
 */
class Insert extends AbstractMysql
{
    use Traits\InsertTrait;
    
    const FLAG_DELAYED = 'DELAYED';
    const FLAG_IGNORE = 'IGNORE';
    const FLAG_HIGH_PRIORITY = 'HIGH_PRIORITY';
    const FLAG_LOW_PRIORITY = 'LOW_PRIORITY';

    protected function build()
    {
        return 'INSERT' . $this->buildFlags() . " INTO {$this->into}"
             . $this->buildValuesForInsert()
             . PHP_EOL;
    }
    
    /**
     *
     * Adds or removes HIGH_PRIORITY flag.
     *
     * @param bool $enable Set or unset flag (default true).
     *
     * @return $this
     *
     */
    public function highPriority($enable = true)
    {
        $this->setFlag(self::FLAG_HIGH_PRIORITY, $enable);
        return $this;
    }

    /**
     *
     * Adds or removes LOW_PRIORITY flag.
     *
     * @param bool $enable Set or unset flag (default true).
     *
     * @return $this
     *
     */
    public function lowPriority($enable = true)
    {
        $this->setFlag(self::FLAG_LOW_PRIORITY, $enable);
        return $this;
    }

    /**
     *
     * Adds or removes IGNORE flag.
     *
     * @param bool $enable Set or unset flag (default true).
     *
     * @return $this
     *
     */
    public function ignore($enable = true)
    {
        $this->setFlag(self::FLAG_IGNORE, $enable);
        return $this;
    }

    /**
     *
     * Adds or removes DELAYED flag.
     *
     * @param bool $enable Set or unset flag (default true).
     *
     * @return $this
     *
     */
    public function delayed($enable = true)
    {
        $this->setFlag(self::FLAG_DELAYED, $enable);
        return $this;
    }
}
