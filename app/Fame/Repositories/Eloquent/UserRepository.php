<?php

namespace Fame\Repositories\Eloquent;

use App\User;
use Fame\Repositories\UserInterface;

class UserRepository extends AbstractRepository implements UserInterface
{
    /**
     * Create a new UserRepository instance.
     *
     * @param \App\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Find all users.
     *
     * @param string $orderColumn
     * @param string $orderDir
     * @return \App\User[]
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
    {
        return $this->model->orderBy($orderColumn, $orderDir)->get();
    }

    /**
     * Find a user by id.
     *
     * @param mixed $id
     * @return \App\User
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a user or create a new one if not available.
     *
     * @param array $data
     * @return \App\User
     */
    public function findOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    /**
     * Create a new user in the database.
     *
     * @param array $data
     * @return \Fama\User
     */
    public function create(array $data)
    {
        $user = $this->getInstance();

        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = ($data['password'] != '') ?
            bcrypt($data['password']) :
            bcrypt(str_random(10));

        //$user->status   = $data['status'];
        $user->avatar = $data['avatar'];

        $user->save();

        return $user;
    }

    /**
     * Update the specified user in the database.
     *
     * @param \App\User $user
     * @param array $data
     * @return \App\User
     */
    public function update(User $user, array $data)
    {
        $user->username = $data['username'];
        $user->password = ($data['password'] != '') ? bcrypt($data['password']) : $user->password;

        //TODO: handle avatar image update

        $user->save();

        return $user;
    }

    /**
     * Delete the specified user from the database.
     *
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        $user = $this->findById($id);

        $user->delete();
    }
}
