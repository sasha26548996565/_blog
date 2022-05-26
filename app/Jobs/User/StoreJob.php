<?php

declare(strict_types=1);

namespace App\Jobs\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\User\PasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use League\Config\ReadOnlyConfiguration;

class StoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $password = Str::random(10);
        $this->data['password'] = Hash::make($password);

        $role = $this->data['role'];
        unset($this->data['role']);

        if (isset($this->data['permissions']))
        {
            $permissions = $this->data['permissions'];
            unset($this->data['permissions']);
        }

        $user = User::create($this->data);
        $user->assignRole($role);

        isset($permissions) ? $user->givePermissionTo($permissions) : null;

        Mail::to($this->data['email'])->send(new PasswordMail($password));
        event(new Registered($user));
    }
}
