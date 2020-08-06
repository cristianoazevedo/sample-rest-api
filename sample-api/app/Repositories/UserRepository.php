<?php

namespace App\Repositories;

use App\Exceptions\UserNotFoundException;
use App\Models\Payer\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    /**
     * @var User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param string[] $columns
     * @return User[]|Collection
     */
    public function all(array $columns = ['*'])
    {
        return $this->model::all($columns);
    }

    /**
     * @param $id
     * @return mixed
     * @throws UserNotFoundException
     */
    public function find(int $id)
    {
        try {
            return $this->model::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new UserNotFoundException();
        }
    }
}
