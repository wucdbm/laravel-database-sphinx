<?php

/*
 * This file is part of the wucdbm/sphinx-query-builder package.
 *
 * Copyright (c) Martin Kirilov <wucdbm@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wucdbm\Component\SphinxQueryBuilder;

use Illuminate\Database\MySqlConnection;
use Illuminate\Database\Query\Builder;

class SphinxConnection extends MySqlConnection {

    protected function getDefaultQueryGrammar(): SphinxQLGrammar {
        $grammar = new SphinxQLGrammar();
        $this->withTablePrefix($grammar);

        return $grammar;
    }

    /**
     * @param \Closure|Builder|string $table
     * @param string|null $as
     *
     * @return SphinxQueryBuilder
     */
    public function table($table, $as = null): SphinxQueryBuilder {
        return $this->query()->from($table, $as);
    }

    public function query(): SphinxQueryBuilder {
        return new SphinxQueryBuilder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }
}
