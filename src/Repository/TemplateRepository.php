<?php
/**
 * Created by PhpStorm.
 * User: ihorkruchynenko
 * Date: 03/05/2017
 * Time: 21:50
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class TemplateRepository extends EntityRepository
{
    public function temaplteDetailsTable() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            -> select('t.templateName as TemplateName,
                              t.app as AppName')
            -> from('App:Template', 't')
        ;
        $result = $qb ->getQuery() ->getResult();
        return $result;

    }//concolidated pull function for campaigns dash
}