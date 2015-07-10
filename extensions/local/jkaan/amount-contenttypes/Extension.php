<?php

namespace Bolt\Extension\Jkaan\ContactForm;

use Bolt\Application;
use Bolt\BaseExtension;

class Extension extends BaseExtension
{

    public function initialize()
    {
        $this->addTwigFunction('amountOfContentTypes', 'twigAmountOfContentTypes');
    }

    public function twigAmountOfContentTypes()
    {
        $results = array();

        // Loop over all content types that are defined
        foreach($this->app['config']->get('contenttypes') as $key => $value) {
            $contentType = $key;
            $tableName = $this->app['config']->get('general/database/prefix') . $contentType;
            /* @var $dbal \Doctrine\DBAL\Connections\MasterSlaveConnection */
            $dbal = $this->app['db'];
            $stmt = $dbal->executeQuery('SELECT COUNT(id) FROM ' . $tableName);
            $amountOfContentType = $stmt->fetchAll(\PDO::FETCH_BOTH)[0][0];
            $results[$contentType] = $amountOfContentType;
        }
        return $results;
    }

    public function getName()
    {
        return "amount-contenttypes";
    }

}






