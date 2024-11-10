<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin()
    {
        $bookings = Booking::with(['customer', 'service', 'staff'])->orderBy('created_at', 'desc')->get();

        $pendingBookings = $bookings->whereIn("transaction_status", ["Pending", "Confirmed/Assigned"])->count();
        $inProcessBookings = $bookings->whereIn("transaction_status", ["Received/In Process", "Ready For Pickup/Payment", "For Payment Approval"])->count();
        $completedBookings = $bookings->where("transaction_status", "Complete")->count();
        $unsuccessfulBookings = $bookings->whereIn("transaction_status", ["Rejected", "Cancelled"])->count();

        $dailyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('DATE(booking_schedule) as date, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('MONTH(booking_schedule) as month, YEAR(booking_schedule) as year, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $dailyLabels = $dailyRevenue->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date)); // Format the date as desired (e.g., "Mar 01")
        });

        $dailyRevenues = $dailyRevenue->pluck('total_revenue');

        $monthlyLabels = $monthlyRevenue->map(function ($revenue) {
            return date('F', mktime(0, 0, 0, $revenue->month, 1)); // Convert month number to month name
        });

        $monthlyRevenues = $monthlyRevenue->pluck('total_revenue');

        return view("admin.dashboard", compact(
            'pendingBookings', 
            'inProcessBookings', 
            'completedBookings', 
            'unsuccessfulBookings', 
            'bookings', 
            'dailyRevenue', 
            'monthlyRevenue', 
            'dailyLabels', 
            'dailyRevenues',
            'monthlyLabels',  
            'monthlyRevenues'
        ));
    }
    public function getAllStaffs(){
        $users = User::orderBy('id', 'desc')->where('role', "Staff")->get(); 
        return view("admin.staffRecords.index", compact('users'));
    }
    public function staffRecords($id)
    {
        $staff = User::findOrFail($id);
        $bookings = Booking::with(['customer', 'service', 'staff'])->where('staff_user_id', $id)->orderBy('created_at', 'desc')->get();

        $pendingBookings = $bookings->whereIn("transaction_status", ["Pending", "Confirmed/Assigned"])->where('staff_user_id', $id)->count();
        $inProcessBookings = $bookings->whereIn("transaction_status", ["Received/In Process", "Ready For Pickup/Payment", "For Payment Approval"])->where('staff_user_id', $id)->count();
        $completedBookings = $bookings->where("transaction_status", "Complete")->where('staff_user_id', $id)->count();
        $unsuccessfulBookings = $bookings->whereIn("transaction_status", ["Rejected", "Cancelled"])->where('staff_user_id', $id)->count();

        $dailyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('DATE(booking_schedule) as date, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->where('staff_user_id', $id)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('MONTH(booking_schedule) as month, YEAR(booking_schedule) as year, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->where('staff_user_id', $id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $dailyLabels = $dailyRevenue->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date)); // Format the date as desired (e.g., "Mar 01")
        });

        $dailyRevenues = $dailyRevenue->pluck('total_revenue');

        $monthlyLabels = $monthlyRevenue->map(function ($revenue) {
            return date('F', mktime(0, 0, 0, $revenue->month, 1)); // Convert month number to month name
        });

        $monthlyRevenues = $monthlyRevenue->pluck('total_revenue');

        return view("admin.staffRecords.dashboard", compact(
            'pendingBookings', 
            'inProcessBookings', 
            'completedBookings', 
            'unsuccessfulBookings', 
            'bookings', 
            'staff',
            'dailyRevenue', 
            'monthlyRevenue', 
            'dailyLabels', 
            'dailyRevenues',
            'monthlyLabels',  
            'monthlyRevenues'
        ));
    }
    public function staff(){
        $bookings = Booking::with(['customer', 'service'])->where('staff_user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        $pendingBookings = $bookings->whereIn("transaction_status", ["Pending", "Confirmed/Assigned"])->where('staff_user_id', auth()->id())->count();
        $inProcessBookings = $bookings->whereIn("transaction_status", ["Received/In Process", "Ready For Pickup/Payment", "For Payment Approval"])->where('staff_user_id', auth()->id())->count();
        $completedBookings = $bookings->where("transaction_status", "Complete")->where('staff_user_id', auth()->id())->count();
        $unsuccessfulBookings = $bookings->whereIn("transaction_status", ["Rejected", "Cancelled"])->where('staff_user_id', auth()->id())->count();

        $dailyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('DATE(booking_schedule) as date, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->where('staff_user_id', auth()->id())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('MONTH(booking_schedule) as month, YEAR(booking_schedule) as year, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->where('staff_user_id', auth()->id())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $dailyLabels = $dailyRevenue->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date)); // Format the date as desired (e.g., "Mar 01")
        });

        $dailyRevenues = $dailyRevenue->pluck('total_revenue');

        $monthlyLabels = $monthlyRevenue->map(function ($revenue) {
            return date('F', mktime(0, 0, 0, $revenue->month, 1)); // Convert month number to month name
        });

        $monthlyRevenues = $monthlyRevenue->pluck('total_revenue');

        return view("staff.dashboard", compact(
            'pendingBookings', 
            'inProcessBookings', 
            'completedBookings', 
            'unsuccessfulBookings', 
            'bookings', 
            'dailyRevenue', 
            'monthlyRevenue', 
            'dailyLabels', 
            'dailyRevenues',
            'monthlyLabels',  
            'monthlyRevenues'
        ));
    }
    public function customer(){
        $bookings = Booking::with(['customer', 'service'])->where('customer_user_id', auth()->id())->orderBy('created_at', 'desc')->get();

        $pendingBookings = $bookings->whereIn("transaction_status", ["Pending", "Confirmed/Assigned"])->where('customer_user_id', auth()->id())->count();
        $inProcessBookings = $bookings->whereIn("transaction_status", ["Received/In Process", "Ready For Pickup/Payment", "For Payment Approval"])->where('customer_user_id', auth()->id())->count();
        $completedBookings = $bookings->where("transaction_status", "Complete")->where('customer_user_id', auth()->id())->count();
        $unsuccessfulBookings = $bookings->whereIn("transaction_status", ["Rejected", "Cancelled"])->where('customer_user_id', auth()->id())->count();

        $dailyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('DATE(booking_schedule) as date, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->where('customer_user_id', auth()->id())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $monthlyRevenue = Booking::join('services', 'bookings.service_id', '=', 'services.id')
            ->selectRaw('MONTH(booking_schedule) as month, YEAR(booking_schedule) as year, SUM(services.price) as total_revenue')
            ->where('transaction_status', 'Complete')
            ->where('customer_user_id', auth()->id())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $dailyLabels = $dailyRevenue->pluck('date')->map(function ($date) {
            return date('M d', strtotime($date)); // Format the date as desired (e.g., "Mar 01")
        });

        $dailyRevenues = $dailyRevenue->pluck('total_revenue');

        $monthlyLabels = $monthlyRevenue->map(function ($revenue) {
            return date('F', mktime(0, 0, 0, $revenue->month, 1)); // Convert month number to month name
        });

        $monthlyRevenues = $monthlyRevenue->pluck('total_revenue');

        return view("customer.dashboard", compact(
            'pendingBookings', 
            'inProcessBookings', 
            'completedBookings', 
            'unsuccessfulBookings', 
            'bookings', 
            'dailyRevenue', 
            'monthlyRevenue', 
            'dailyLabels', 
            'dailyRevenues',
            'monthlyLabels',  
            'monthlyRevenues'
        ));
    }
}
