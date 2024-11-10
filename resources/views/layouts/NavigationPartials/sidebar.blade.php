<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            @if(Auth::user()->role == 'Admin')
                <div class="sb-sidenav-menu-heading">Summary</div>
                <a class="nav-link" href="{{url('admin/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{url('admin/staffRecords/index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Staff Records
                </a>
                <div class="sb-sidenav-menu-heading">Profiles</div>
                <a class="nav-link" href="{{ route('service.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Services
                </a>
                <a class="nav-link" href="{{ route('equipment.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Equipments
                </a>
                <a class="nav-link" href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Users
                </a>
                <div class="sb-sidenav-menu-heading">Transactions</div>
                <a class="nav-link" href="{{route('confirmBooking.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Confirm Bookings
                </a>
                <a class="nav-link" href="{{ url('admin/payment/completed') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Completed Transactions
                </a>
                <a class="nav-link" href="{{ url('admin/confirmBooking/cancelledRejected') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Rejected/Cancelled
                </a>
                <a class="nav-link" href="{{ url('admin/confirmBooking/trackBookings') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Track Bookings
                </a>
            @endif
            @if(Auth::user()->role == 'Staff')
            <div class="sb-sidenav-menu-heading">Summary</div>
            <a class="nav-link" href="{{url('staff/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Transactions</div>
            <a class="nav-link" href="{{ route('assignedBooking.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Assigned Bookings
            </a>
            <a class="nav-link" href="{{ route('staffPaymentApproval.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Payments Approval
            </a>
            <a class="nav-link" href="{{ url('staff/payment/completed') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Completed Transactions
            </a>
            <a class="nav-link" href="{{ url('staff/assignedBooking/trackBookings') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Track Bookings
            </a>
            <div class="sb-sidenav-menu-heading">Equipments</div>
            <a class="nav-link" href="{{ route('equipmentMonitoring.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Monitor Equipments
            </a>
            @endif
            @if(Auth::user()->role == 'Customer')
                <div class="sb-sidenav-menu-heading">Summary</div>
                <a class="nav-link" href="{{url('customer/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Transactions</div>
                <a class="nav-link" href="{{ route('booking.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Booking Page
                </a>
                <a class="nav-link" href="{{ url('customer/booking/cancelledRejected') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Rejected/Cancelled
                </a>
                <a class="nav-link" href="{{ route('billing.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Billings/Payments
                </a>
                <a class="nav-link" href="{{ route('payment.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Completed Transactions
                </a>
                <a class="nav-link" href="{{ url('customer/booking/trackBookings') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Track Bookings
                </a>
            @endif   
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: </div>
        {{ Auth::user()->role }}
    </div>
</nav>