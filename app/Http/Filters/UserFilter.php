<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    public const ROLE = 'role';
    public const PERMISSIONS = 'permissions';
    public const SEARCH = 'search';

    protected function getCallbacks(): array
    {
        return [
            self::ROLE => [$this, 'role'],
            self::PERMISSIONS => [$this, 'permissions'],
            self::SEARCH => [$this, 'search']
        ];
    }

    public function role(Builder $builder, $value)
    {
        $builder->role($value);
    }

    public function permissions(Builder $builder, $value)
    {
        $builder->permission($value);
    }

    public function search(Builder $builder, $value): void
    {
        $builder->where('name', 'LIKE', "%{$value}%")->orWhere('email', 'LIKE', "%{$value}%");
    }
}
