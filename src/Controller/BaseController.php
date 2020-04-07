<?php

declare(strict_types=1);


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return parent::getUser();
    }
}
