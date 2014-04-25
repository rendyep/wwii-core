<?php

namespace WWII\Controller;

interface ControllerInterface
{
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager);

    public function getEntityManager();

    public function run();
}
