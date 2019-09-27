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

class SphinxQueryBuilder extends Builder {

    /** @var int */
    public $maxMatches = 1000;

    public function maxMatches(int $maxMatches): self {
        $this->maxMatches = $maxMatches;

        return $this;
    }
}
