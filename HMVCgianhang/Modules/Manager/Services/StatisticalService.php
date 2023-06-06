<?php
namespace Modules\Manager\Services;

use Modules\Manager\Repositories\HistoryOrderRepositoryInterface;
use Illuminate\Support\Arr;

class StatisticalService
{
    public function __construct(HistoryOrderRepositoryInterface $historyOrderRepo)
    {
        $this->historyOrderRepo = $historyOrderRepo;
    }

    public function monthly($month, $year)
    {
        // số ngày có trong tháng đó
        $number_day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    
        for ($i=0; $i < $number_day; $i++) { 
            $d = mktime(0,0,0,$month,$i+1,$year);
            $date = date("Y-m-d H:i:s", $d);
            $days[$i] = $date;
            if($date > now())
            {
                break;
            }           
        }
        $statistical['day'] = $days;
        $statistical['turn_over'] = [];
        for ($i=0; $i<sizeof($days)-1; $i++)
        {
            array_push($statistical['turn_over'], $this->getTurnOver($days[$i],$days[$i+1]));
        }

        return $statistical;
    }

    public function yearly($year)
    {
        for ($i=0; $i<12; $i++)
        {
            $d = mktime(0,0,0,$i+1,1,$year);
            $date = date("Y-m-d H:i:s", $d);
            $days[$i] = $date;
            if($date > now())
            {
                break;
            }   
        }
        $statistical['day'] = $days;
        $statistical['turn_over'] = [];
        for ($i=0; $i<sizeof($days)-1; $i++)
        {
            array_push($statistical['turn_over'], $this->getTurnOver($days[$i],$days[$i+1]));
        }


        return $statistical;
    }

    public function getTurnOver($start,$end)
    {
        $data = $this->historyOrderRepo->getTurnOver($start,$end)->toArray();
        $turnOver = Arr::pluck($data,'total');
        return array_sum($turnOver);
    }

}