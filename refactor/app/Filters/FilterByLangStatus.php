<?php


class FilterByLangStatus
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        if (request('lang') && request('lang') != '') {
            $builder->whereIn('from_language_id', request('lang'));
        }
        if (request('status') && request('status') != '') {
            $builder->whereIn('status', request('status'));
        }

        return $builder;
    }
}