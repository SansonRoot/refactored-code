<?php


class OrderByCreatedAt
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        $builder->orderBy('created_at', 'desc');

        return $builder;
    }
}