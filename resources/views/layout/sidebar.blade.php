@php
    $allowedRoles = ['staff', 'super-admin','user','department-head'];
@endphp
@if (in_array(Auth::user()->role, $allowedRoles))
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link rel="icon" href="{{ asset('Images/RTM-Logo.jpg') }}">
<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

@stack('styles')

<style>
:root{
    --primary:#1e3a8a;
    --dark:#0f172a;
    --sidebar:#020617;
    --hover:#1e293b;
    --text:#cbd5e1;
    --muted:#94a3b8;
    --white:#ffffff;
    --active-bg:#1e3a8a;
    --active-text:#ffffff;
    --active-border:#ffdd57;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Inter", "Segoe UI", sans-serif;
}

/* TOPBAR */
.topbar{
    height:45px;
    background:var(--white);
    border-bottom:1px solid #e5e7eb;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 24px;
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1000;
    font-size:12px;
}

.topbar .left{
    display:flex;
    align-items:center;
    gap:16px;
}
.menu-btn{
    font-size:22px;
    cursor:pointer;
}
.brand{
    font-weight:700;
    font-size:14px;
    color:var(--primary);
}

/* USER */
.user-box{
    display:flex;
    align-items:center;
    gap:12px;
}
.user-box .info{
    text-align:right;
}
.user-box small{
    color:var(--muted);
}

/* SIDEBAR */
.sidebar{
    width:200px;
    background:var(--sidebar);
    height:100vh;
    position:fixed;
    top:45px;
    left:0;
    overflow-y:auto;
    transition:.3s;
    font-size:12px;
}
.sidebar.collapsed{
    width:0;
}

.menu-section{
    padding:14px 20px;
    font-size:11px;
    color:var(--muted);
    text-transform:uppercase;
}

.sidebar a,
.dropdown-btn{
    width:100%;
    padding:8px 10px;
    display:flex;
    align-items:center;
    gap:12px;
    color:var(--text);
    text-decoration:none;
    border:none;
    background:none;
    cursor:pointer;
    transition:.2s;
}

.sidebar a:hover,
.dropdown-btn:hover{
    background:var(--hover);
    color:#fff;
}

/* Active Styles */
.sidebar a.active,
.dropdown-btn.active{
    background: var(--active-bg);
    color: var(--active-text);
    font-weight: 600;
    border-left: 4px solid var(--active-border);
}

/* Dropdown */
.dropdown-btn{
    justify-content:space-between;
}
.dropdown-container{
    display:none;
}
.dropdown-container a{
    padding-left:30px;
}

/* MAIN */
.main{
    margin-left:200px;
    margin-top:15px;
    padding:28px;
    transition:.3s;
}
.main.full{
    margin-left:0;
}
.fa-user{
    color: blue;
}

/* MOBILE */
@media(max-width:768px){
    .sidebar{width:0;}
    .main{margin-left:0;}
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="left">
        <i class="fas fa-bars menu-btn" onclick="toggleSidebar()"></i>
        <div class="brand">Department of CSE,RTM-AKTU</div>
    </div>

    <div class="user-box">
        <div class="info">
            <strong>{{ Auth::user()->name ?? 'Admin' }}</strong><br>
            <smalln style="color: darkblue; font-size:12px;">{{ Ucwords(Auth::user()->role ?? 'Super Admin') }}</small>
        </div>
        <i class="fa fa-user fa-lg" aria-hidden="true"></i>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <div class="menu-section">General</div>

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-line"></i> Dashboard
    </a>

    <a href="{{ route('password.change') }}" class="{{ request()->routeIs('password.change') ? 'active' : '' }}">
        <i class="fas fa-key"></i> Change Password
    </a>

    <div class="menu-section">Academic</div>

    <!-- Students -->
    @php
        $studentsActive = request()->routeIs('students.*') ? 'active' : '';
        $alumniActive = request()->routeIs('alumni.*') ? 'active' : '';
    @endphp
    <button class="dropdown-btn {{ $studentsActive }}">
        <span><i class="fas fa-user-graduate"></i> Students</span>
        <i class="fas fa-chevron-down"></i>
    </button>
    <div class="dropdown-container" style="{{ $studentsActive || $alumniActive ? 'display:block;' : '' }}">
        <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.index') ? 'active' : '' }}">General Students</a>
        <a href="{{ route('alumni.index') }}" class="{{ request()->routeIs('alumni.index') ? 'active' : '' }}">Alumni Students</a>
    </div>

    <!-- Faculty & Notices -->
    <a href="{{ route('faculty.index') }}" class="{{ request()->routeIs('faculty.*') ? 'active' : '' }}">
        <i class="fas fa-chalkboard-teacher"></i> Faculty 
    </a>

    <a href="{{ route('notices.index') }}" class="{{ request()->routeIs('notices.*') ? 'active' : '' }}">
        <i class="fas fa-bullhorn"></i> Notices
    </a>

    <!-- Courses -->
    @php
        $coursesActive = request()->routeIs('courses.*') ? 'active' : '';
    @endphp
    <button class="dropdown-btn {{ $coursesActive }}">
        <span><i class="fas fa-book"></i> Courses</span>
        <i class="fas fa-chevron-down"></i>
    </button>
    <div class="dropdown-container" style="{{ $coursesActive ? 'display:block;' : '' }}">
        <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.index') ? 'active' : '' }}">Course</a>
        <a href="{{ route('courses.curriculum') }}" class="{{ request()->routeIs('courses.curriculum') ? 'active' : '' }}"> Course Curriculum</a>
        <a href="{{ route('courses.teacher') }}" class="{{ request()->routeIs('courses.teacher') ? 'active' : '' }}">Course Teacher</a>
    </div>

    <!-- Batches -->
    @php
        $batchesActive = request()->routeIs('batches.*') ? 'active' : '';
    @endphp
    <button class="dropdown-btn {{ $batchesActive }}">
        <span><i class="fas fa-layer-group"></i> Batches</span>
        <i class="fas fa-chevron-down"></i>
    </button>
    <div class="dropdown-container" style="{{ $batchesActive ? 'display:block;' : '' }}">
        <a href="{{ route('batches.supervisor') }}" class="{{ request()->routeIs('batches.supervisor') ? 'active' : '' }}">Supervisor</a>
    </div>

    <div class="menu-section">Administration</div>
      @if (Auth::user()->role === 'super-admin' || Auth::user()->role === 'staff'  )

    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Users & Roles
    </a>
     @endif

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button style="background:none;border:none;color:white;width:100%;text-align:left;padding:8px 10px;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>

</div>

<!-- MAIN -->
<div class="main" id="main">
    @yield('content')
</div>

@stack('scripts')

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("collapsed");
    document.getElementById("main").classList.toggle("full");
}

/* Dropdown */
document.querySelectorAll(".dropdown-btn").forEach(btn=>{
    btn.addEventListener("click",()=>{
        const box = btn.nextElementSibling;
        box.style.display = box.style.display==="block" ? "none" : "block";
    });
});
</script>

</body>
</html>
@endif