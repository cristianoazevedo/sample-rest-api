<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\Payer\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class User
 * @package App\Services
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repository->all(['id', 'name']);
    }

    /**
     * @param int $id
     * @return User|null
     * @throws UserNotFoundException
     */
    public function find(int $id): ?User
    {
        return $this->repository->find($id, ['id', 'name']);
    }
}
