<?php

namespace App\Http\Controllers\Laporan;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\LaporanSales;
use App\Models\General_model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportJourneyPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Logistik')) {
            $users = User::role('Driver')->pluck('name', 'id');
        } else {
            $users = User::pluck('name', 'id');
        }

        return view('reportsales.journey-plan', compact('users'));
    }

    public function indexReport(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $userId = $request->user;
        $startDate = Carbon::parse($request->start)->startOfMonth();
        $endDate = Carbon::parse($request->end)->endOfMonth();

        $user = User::findOrFail($userId);

        // Get all visit reports for the user in the period
        $laporanQuery = LaporanSales::with(['general'])
            ->join('jadwals', 'laporan_sales.jadwal_id', '=', 'jadwals.id')
            ->where('laporan_sales.user_id', $userId)
            ->whereBetween('jadwals.date', [$startDate->toDateString(), $endDate->toDateString()])
            ->select('laporan_sales.*', 'jadwals.date as visit_date');

        $laporan = $laporanQuery->get();

        // Prepare Pivot Data
        $customers = [];
        $months = [];
        $tempDate = clone $startDate;
        while ($tempDate <= $endDate) {
            $months[] = $tempDate->format('M Y');
            $tempDate->addMonth();
        }

        $pivotData = [];
        $newCustomers = [];
        
        // Identify new customers (added within the period)
        $newCustomersInPeriod = General_model::whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()])
            ->pluck('id')
            ->toArray();

        foreach ($laporan as $item) {
            $customerId = $item->general_id;
            $customerName = optional($item->general)->nama_usaha ?? 'Unnamed Customer';
            $monthKey = Carbon::parse($item->visit_date)->format('M Y');

            if (!isset($pivotData[$customerId])) {
                $pivotData[$customerId] = [
                    'name' => $customerName,
                    'months' => array_fill_keys($months, 0),
                    'total' => 0,
                    'is_new' => in_array($customerId, $newCustomersInPeriod)
                ];
            }

            $pivotData[$customerId]['months'][$monthKey]++;
            $pivotData[$customerId]['total']++;
        }

        // Calculate Totals per month
        $monthlyGrandTotal = array_fill_keys($months, 0);
        $overallTotal = 0;
        foreach ($pivotData as $data) {
            foreach ($data['months'] as $m => $count) {
                $monthlyGrandTotal[$m] += $count;
            }
            $overallTotal += $data['total'];
        }

        // Analisa Calculations
        $totalVisits = $overallTotal;
        $totalCustomers = count($pivotData);
        $totalNewCustomers = 0;
        $singleVisitCustomers = 0;
        $newCustPerMonth = array_fill_keys($months, 0);
        foreach($pivotData as $data) {
            if ($data['is_new']) {
                $totalNewCustomers++;
                foreach ($months as $m) {
                    if ($data['months'][$m] > 0) {
                        $newCustPerMonth[$m]++;
                    }
                }
            }
            if ($data['total'] == 1) $singleVisitCustomers++;
        }

        $workDays = count($months) * 20;

        $avgVisitsPerDay = $workDays > 0 ? round($totalVisits / $workDays) : 0;
        $avgNewCustPerDay = $workDays > 0 ? round($totalCustomers / $workDays) : 0;

        // Trend calculation (simplified: compare last month to previous month if available)
        $trend = "Data is stable";
        if (count($months) >= 2) {
            $lastMonth = $months[count($months) - 1];
            $prevMonth = $months[count($months) - 2];
            if ($monthlyGrandTotal[$lastMonth] > $monthlyGrandTotal[$prevMonth]) {
                $trend = "Trend visit naik dari bulan ke bulan berikutnya";
            } elseif ($monthlyGrandTotal[$lastMonth] < $monthlyGrandTotal[$prevMonth]) {
                $trend = "Trend visit menurun dibandingkan bulan sebelumnya";
            }
        }

        $analysis = [
            'trend' => $trend,
            'new_cust_count' => $totalNewCustomers,
            'single_visit_count' => $singleVisitCustomers,
            'total_customers' => $totalCustomers,
            'avg_new_cust' => $avgNewCustPerDay,
            'total_visits' => $totalVisits,
            'avg_visits' => $avgVisitsPerDay,
            'period_months' => count($months)
        ];

        return view('reportsales.journey-plan-result', compact(
            'user', 
            'startDate', 
            'endDate', 
            'months', 
            'pivotData', 
            'monthlyGrandTotal', 
            'overallTotal',
            'analysis',
            'newCustPerMonth'
        ));
    }
}
