<?php


class FilterByTranslator
{
//implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        //handle issue of single customer email or multiple emails sent
        $translators = request('translator_email');
        if ($translators && !is_array($translators))
            $translators = [$translators];

        if ($translators && count($translators) && $translators != '') {
            $users = DB::table('users')->whereIn('email', $translators)->get();
            if ($users) {
                $allJobIDs = DB::table('translator_job_rel')->whereNull('cancel_at')->whereIn('user_id', collect($users)->pluck('id')->all())->lists('job_id');
                $builder->whereIn('id', $allJobIDs);
            }
        }

        return $builder;
    }
}