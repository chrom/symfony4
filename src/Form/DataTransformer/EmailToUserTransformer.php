<?php

namespace App\Form\DataTransformer;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EmailToUserTransformer implements DataTransformerInterface
{
    private $userRepository;
    private $finderCallback;

    public function __construct(UserRepository $userRepository, callable $finderCallback)
    {
        $this->userRepository = $userRepository;
        $this->finderCallback = $finderCallback;
    }

    /**
     * Render value to form
     *
     * @param User $value
     * @return mixed|string
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof User) {
            throw new \LogicException('The UserSelectTextType can only be used with User objects');
        }
        return $value->getEmail();
    }

    /**
     * Transform data from form sending
     *
     * @param mixed $value
     * @return mixed|void
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return;
        }

        $user = ($this->finderCallback)($this->userRepository, $value);

        if (!$user) {
            throw new TransformationFailedException(sprintf('No user found with email "%s"', $value));
        }

        return $user;
    }
}