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

class SphinxConnection extends MySqlConnection {

    /**
     * @return SphinxQLGrammar
     */
    protected function getDefaultQueryGrammar() {
        return $this->withTablePrefix(new SphinxQLGrammar());
    }

    /**
     * @param \Closure|\Illuminate\Database\Query\Builder|string $table
     * @param string|null                                        $as
     *
     * @return SphinxQueryBuilder
     */
    public function table($table, $as = null) {
        return $this->query()->from($table, $as);
    }

    /**
     * @return SphinxQueryBuilder
     */
    public function query() {
        return new SphinxQueryBuilder(
            $this, $this->getQueryGrammar(), $this->getPostProcessor()
        );
    }
}
