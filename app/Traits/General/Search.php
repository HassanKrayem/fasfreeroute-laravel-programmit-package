<?php

namespace Programmit\Traits\General;

trait Search
{   

    public function modelSearchFromToDate ($request, $modelCollection)
    {

        if (isset($request['comp_search_date_from']) && isset($request['comp_search_date_to'])) {
            $fDate = $request['comp_search_date_from']; $tDate = $request['comp_search_date_to'];
            if (!empty($fDate) && !empty($tDate)) {

                $fDate = \Carbon\Carbon::createFromFormat('d/m/Y', $fDate);
                $tDate = \Carbon\Carbon::createFromFormat('d/m/Y', $tDate);
                if ( $fDate !== FALSE && $tDate !== FALSE) {

                    if($tDate->diffInDays($fDate) > 0)
                    {
                        return $modelCollection->whereBetween('created_at', [$fDate, $tDate])->latest();
                    }

                }
            }
        }

        return $modelCollection;
            
    }

    public function modelMultupleSearch ($modelCollection, $operations = [])
    {
        foreach ($operations as $o) {
            $modelCollection = $modelCollection->where($o[0], $o[1], $o[2]);
        }
        return $modelCollection;
    }

    public function compModelSearchFromUserQuery ($request, $modelCollection, &$dataPackage, $searchTargets = [])
    {
        $searchIsOn = false;
        $searchQuery = trim($request->get('comp_search_query'));
        $result = $modelCollection;

        if (!empty($searchQuery)) {
            $searchIsOn = true;
            $isExact = substr($searchQuery, -1) != '*'; // escaping can be here

            if (!$isExact) {
                $searchQuery = self::search_escape_like(substr($searchQuery, 0, -1));
                $searchOperator = "%";    
            }
            else {
                $searchQuery = self::search_escape_like($searchQuery);
                $searchOperator = "";
            }

            $result = $result->where('label', 'like', $searchQuery . $searchOperator);

            $dataPackage['search_is_on'] = true;
            $dataPackage['comp_search_query'] = $searchQuery;
            if(!$isExact)
                $dataPackage['comp_search_query'] = $searchQuery . "*";

        }
        else {
            $dataPackage['comp_search_query'] = "Search All";
        }

        return $result;        
    }

    /**
     * @param $string
     * @return mixed
     * @Description escape string for MySQL
     */
    function search_escape_like($string)
    {
        $search = array('%', '_');
        $replace   = array('\%', '\_');
        return str_replace($search, $replace, $string);
    }
}