<?php

namespace App\Actions\User;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StoreAction
{
    public function handle(array $data): void
    {
        try
        {
            DB::beginTransaction();

            $password = Str::random(10);
            $data['password'] = Hash::make($password);

            $role = $data['role'];
            unset($data['role']);

            if (isset($data['permissions']))
            {
                $permissions = $data['permissions'];
                unset($data['permissions']);
            }

            $user = User::create($data);
            $user->assignRole($role);

            isset($permissions) ? $user->givePermissionTo($permissions) : null;

            Mail::to($data['email'])->send(new PasswordMail($password));
            event(new Registered($user));

            DB::commit();
        } catch (\Exception $exception)
        {
            DB::rollback();
            abort(500);
        }
    }
}
