<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThongKe; // Đảm bảo đã import model

class AdminAnalysisController extends Controller
{
    public $viewData = [];
    public function index(Request $request)
    {
        $viewData['title'] = "Trang quản trị - thống kê";
        return view('admin.analysis.index')->with('viewData', $viewData);
    }

    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['startDate'];
        $to_date = $data['endDate'];

        $get = ThongKe::whereBetween('order_date', [$from_date, $to_date])
            ->orderBy('order_date', 'ASC')
            ->get();

        // Khai báo mảng trống
        $chart_data = [];

        foreach ($get as $key => $val) {

            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }
}
