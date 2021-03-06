<?php

namespace Preferred\Domain\Users\Listeners\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Neves\Events\Contracts\TransactionalEvent;
use Preferred\Domain\Users\Entities\LoginHistory;
use Ramsey\Uuid\Uuid;

class LoginHistoryObserver implements TransactionalEvent
{
    public function creating(Model $model)
    {
        $model->id = Uuid::uuid4();

        if (auth()->check()) {
            $model->user_id = auth()->id();
        }
    }

    public function created(LoginHistory $loginHistory)
    {
        Cache::tags('users:' . $loginHistory->user_id)->flush();
    }
}
