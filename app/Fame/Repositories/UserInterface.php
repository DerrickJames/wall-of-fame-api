<?php

namespace Fame\Repositories;

use App\User;

interface UserInterface
{
    /**
     * Find all users.
     *
     * @param string $orderColumn
     * @param string $orderDir
     * @return \App\Entities\User[]
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc');

    /**
     * Find a user by id.
     *
     * @param mixed $id
     * @return \App\Entities\User
     */
    public function findById($id);

    /**
     * Find a user or create a new one if not available.
     *
     * @param array $data
     * @return \App\User
     */
    public function findOrCreate(array $data);

    /**
     * Create a new user in the database.
     *
     * @param array $data
     * @return \Fama\Entities\User
     */
    public function create(array $data);

    /**
     * Update the specified user in the database.
     *
     * @param \App\Entities\User $user
     * @param array $data
     * @return \App\Entities\User
     */
    public function update(User $user, array $data);

    /**
     * Delete the specified user from the database.
     *
     * @param mixed $id
     * @return void
     */
    public function delete($id);
}
