<?php


class FetchEagerLoad
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        //access filters through the global request() function
        $builder->with('user', 'language', 'feedback.user', 'translatorJobRel.user', 'distance');

        return $builder;
    }
}