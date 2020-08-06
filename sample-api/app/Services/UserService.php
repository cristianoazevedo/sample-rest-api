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
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return User[]|Collection
     */
    public function getAll()
    {
        return $this->repository->all(['id', 'name']);
    }

    /**
     * @param $id
     * @return mixed
     * @throws UserNotFoundException
     */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }
}
