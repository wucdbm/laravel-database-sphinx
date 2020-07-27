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

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\MySqlGrammar;

class SphinxQLGrammar extends MySqlGrammar {

    protected function compileLimit(Builder $query, $limit): string {
        if ($query->offset) {
            return sprintf('LIMIT %d, %d', (int) $query->offset, (int) $limit);
        }

        return parent::compileLimit($query, $limit);
    }

    protected function compileOffset(Builder $query, $offset): string {
        return '';
    }

    /**
     * @param SphinxQueryBuilder $query
     *
     * @return string
     */
    public function compileSelect(Builder $query): string {
        $sql = parent::compileSelect($query);

        return sprintf('%s OPTION max_matches = %d', $sql, $query->maxMatches);
    }
}
