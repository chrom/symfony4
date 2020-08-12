<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @method User getUser()
 */
abstract class BaseController extends AbstractController
{
}
