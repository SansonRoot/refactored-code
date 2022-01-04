<?php


class FetchCount
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);


        if (request('count') && request('count') == 'true') {
            $c = $builder->count();

            return ['count' => $c];
        }

        return $builder;
    }
}