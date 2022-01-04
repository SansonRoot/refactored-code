<?php


class FilterByExpiry
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        if (request('expired_at') && request('expired_at') != '') {
            $builder->where('expired_at', '>=', request('expired_at'));
        }
        if (request('will_expire_at') && request('will_expire_at') != '') {
            $builder->where('will_expire_at', '>=', request('will_expire_at'));
        }

        return $builder;
    }
}