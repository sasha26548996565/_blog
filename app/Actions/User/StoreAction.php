<?php

namespace App\Actions\User;

use App\Jobs\User\StoreJob;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function handle(array $data): void
    {
        DB::beginTransaction();

        try
        {
            StoreJob::dispatch($data);

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }
}
