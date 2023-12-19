<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;

class BaseFilters
{

    protected $safeParms = [];
    protected $columnMap = [];
    protected $operatorMap = [];

    public function transform(Request $request): array
    {


        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);


            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    if ($this->operatorMap[$operator] == "LIKE") $query[$operator] = "%" . $query[$operator] . "%";
                    array_push($eloQuery, [$column, $this->operatorMap[$operator], $query[$operator]]);
                }
            }
        }

        return $eloQuery;
    }

}
