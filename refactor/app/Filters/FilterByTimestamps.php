<?php


class FilterByTimestamps
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        if (request('filter_timetype') && request('filter_timetype') == "created") {
            if (request('from') && request('from') != '') {
                $builder->where('created_at', '>=', request('from'));
            }
            if (request('to') && request('to') != "") {
                $to = request('to') . " 23:59:00";
                $builder->where('created_at', '<=', $to);
            }
            $builder->orderBy('created_at', 'desc');
        }

        if (request('filter_timetype') && request('filter_timetype') == "due") {

            if (request('from') && request('from') != '') {
                $builder->where('due', '>=', request('from'));
            }
            if (request('to') && request('to') != '') {
                $to = request('to') . " 23:59:00";
                $builder->where('due', '<=', $to);
            }
            $builder->orderBy('due', 'desc');
        }

        return $builder;
    }

}