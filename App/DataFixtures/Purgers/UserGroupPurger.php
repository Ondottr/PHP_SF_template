<?php declare( strict_types=1 );

/*
 * Copyright © 2018-2022, Nations Original Sp. z o.o. <contact@nations-original.com>
 *
 * Permission to use, copy, modify, and/or distribute this software for any purpose with or without fee is hereby
 * granted, provided that the above copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED \"AS IS\" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE
 * INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE
 * LIABLE FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER
 * RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER
 * TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 */

namespace App\DataFixtures\Purgers;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Common\DataFixtures\Purger\ORMPurgerInterface;


final class UserGroupPurger implements ORMPurgerInterface, CustomPurgerInterface
{
    public function purge(): void
    {
        $queries = file( __DIR__ . '/../../../Doctrine/fixtures/user_groups_purger.sql', FILE_SKIP_EMPTY_LINES );

        // Delete user_group table, functions and triggers
        foreach ( $queries as $q )
            em()
                ->createNativeQuery( $q, new ResultSetMappingBuilder( em() ) )
                ->execute();
    }

    public function setEntityManager( EntityManagerInterface $em ): void {}

}
