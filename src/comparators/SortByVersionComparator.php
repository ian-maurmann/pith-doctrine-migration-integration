<?php
# ===================================================================
# Copyright (c) 2008-2024 Ian K Maurmann. The Pith Framework is
# provided under the terms of the Mozilla Public License, v. 2.0
#
# This Source Code Form is subject to the terms of the Mozilla Public
# License, v. 2.0. If a copy of the MPL was not distributed with this
# file, You can obtain one at http://mozilla.org/MPL/2.0/.
# ===================================================================

/**
 * Sort By Version comparator
 * --------------------------
 *
 * For info on comparators for Doctrine migrations, see:
 * - Issue post: https://github.com/doctrine/migrations/issues/1074
 * - Post on Goetas's blog: https://www.goetas.com/blog/multi-namespace-migrations-with-doctrinemigrations-30/
 * - Post by Fezfez: https://github.com/doctrine/migrations/issues/1074#issuecomment-761580607
 *
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpMethodNamingConventionInspection   - Long method names are ok.
 * @noinspection PhpVariableNamingConventionInspection - Short variable names are ok.
 * @noinspection SpellCheckingInspection               - Ignore spell checking here, GitHub usernames are ok.
 */

declare(strict_types=1);

namespace Pith\PithDoctrineMigrationIntegration;

use Doctrine\Migrations\Version\Comparator;
use Doctrine\Migrations\Version\Version;

use function array_pop;
use function explode;
use function strcmp;

/**
 * Class SortByVersionComparator
 * @package Pith\PithDoctrineMigrationIntegration
 *
 * Mostly inspired from post by Fezfez, see: https://github.com/doctrine/migrations/issues/1074#issuecomment-761580607
 */
class SortByVersionComparator implements Comparator
{
    public function compare(Version $a, Version $b): int
    {
        return strcmp($this->getVersionWithoutNamespace($a), $this->getVersionWithoutNamespace($b));
    }

    public function getVersionWithoutNamespace(Version $version): string
    {
        $namespace_parts = explode('\\', (string) $version);

        return array_pop($namespace_parts);
    }
}