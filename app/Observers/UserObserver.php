<?php
namespace App\Observers;

use Hashids;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $user->hashed_id = Hashids::encode($user->id);
        $user->save();
    }
}
