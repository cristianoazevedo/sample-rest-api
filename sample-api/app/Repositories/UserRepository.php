<?php

namespace App\Repositories;

use App\Exceptions\UserNotFoundException;
use App\Models\Payer\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @var User
     */
    private User $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array|string[] $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model::all($columns);
    }

    /**
     * @param int $id
     * @param array|string[] $columns
     * @return User|null
     * @throws UserNotFoundException
     */
    public function find(int $id, array $columns = ['*']): ?User
    {
        try {
            return $this->model::findOrFail($id, $columns);
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException();
        }
    }
}
