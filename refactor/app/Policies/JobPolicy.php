<?php

class JobPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function update(User $user, Job $job)
    {


    }

    //policy to authorize index viewing
    public function viewAny(User $user, Job $job)
    {
        return $user->user_type == env('ADMIN_ROLE_ID') || $user->user_type == env('SUPERADMIN_ROLE_ID');
    }

    public function view(User $user, Job $job)
    {

    }

    public function delete(User $user, Job $job)
    {

    }



}