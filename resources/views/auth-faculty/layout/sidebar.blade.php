<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link rel="icon" href="{{ asset('Images/RTM-Logo.jpg') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
@stack('styles')

<style>
:root{
    --primary:#d44f11;
    --dark:#0f172a;
    --sidebar:#f7f3e5;
    --hover:#1f2937;
    --text:#051433;
    --muted:#9ca3af;
    --white:#ffffff;
    --active-bg:#1e3a8a;
    --active-text:#ffffff;
    --active-border:#facc15;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Inter", "Segoe UI", sans-serif;
}

/* TOPBAR */
.topbar{
    height:50px;
    background:var(--white);
    border-bottom:1px solid #e5e7eb;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 20px;
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1000;
    font-size:14px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
}

.topbar .left{
    display:flex;
    align-items:center;
    gap:16px;
}
.menu-btn{
    font-size:22px;
    cursor:pointer;
    color:var(--primary);
}
.brand{
    font-weight:700;
    font-size:16px;
    color:var(--primary);
}

/* USER INFO */
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
    width:220px;
    background:var(--sidebar);
    height:100vh;
    position:fixed;
    top:50px;
    left:0;
    overflow-y:auto;
    transition:.3s;
    font-size:14px;
}
.sidebar.collapsed{
    width:0;
}

.menu-section{
    padding:15px 20px;
    font-size:12px;
    color:var(--muted);
    text-transform:uppercase;
}

.sidebar a,
.dropdown-btn{
    width:100%;
    padding:10px 18px;
    display:flex;
    align-items:center;
    gap:12px;
    color:var(--text);
    text-decoration:none;
    border:none;
    background:none;
    cursor:pointer;
    transition:.2s;
    border-left:4px solid transparent;
}

.sidebar a:hover,
.dropdown-btn:hover{
    background:var(--hover);
    color:#fff;
}

/* Active */
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
    flex-direction:column;
}
.dropdown-container a{
    padding-left:35px;
    font-size:13px;
}

/* MAIN */
.main{
    margin-left:220px;
    margin-top:60px;
    padding:30px;
    transition:.3s;
}
.main.full{
    margin-left:0;
}

/* Footer */
.dashboard-footer{
    text-align:center;
    font-size:12px;
    color:var(--muted);
    border-top:1px solid #e5e7eb;
    padding:12px 0;
    margin-top:50px;
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
        <div class="brand">CSE Department | RTM-AKTU</div>
    </div>

    <div class="user-box">
        <div class="info">
            <strong>{{ Auth::guard('faculty')->user()->name ?? 'Faculty' }}</strong><br>
            <small style="color:darkblue;"><b>{{ ucwords(Auth::guard('faculty')->user()->role ?? 'N/A') }}</b></small>
        </div>
        <i class="fa fa-user fa-lg" aria-hidden="true" style="color:#1e3a8a;"></i>
    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-line"></i> Dashboard
    </a>

    <a href="#" class="{{ request()->routeIs('password.change') ? 'active' : '' }}">
        <i class="fas fa-key"></i> Change Password
    </a>

     <a href="#" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
               <i class="fas fa-user-graduate"></i> Students</span>
    </a>

    <a href="{{ route('faculty.courses.taught') }}" class="{{ request()->routeIs('faculty.courses.*') ? 'active' : '' }}">
        <i class="fas fa-book"></i> Courses
    </a>

    <a href="#" class="{{ request()->routeIs('notices.*') ? 'active' : '' }}">
        <i class="fas fa-bullhorn"></i> Notices
    </a>

    <a href="#" class="{{ request()->routeIs('results.*') ? 'active' : '' }}">
        <i class="fas fa-clipboard-list"></i> Results<sub style="color: rgba(255, 72, 0, 0.89);">Coming Soon</sub>
    </a>

    <a href="#" class="{{ request()->routeIs('routine.*') ? 'active' : '' }}">
        <i class="fas fa-calendar-alt"></i> Meeting<sub style="color: rgb(252, 61, 13);">Coming Soon</sub>
    </a>

    <form method="POST" action="#">
        @csrf
        <button style="background:none;border:none;color:black;width:100%;text-align:left;padding:10px 18px;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>

</div>

<!-- MAIN -->
<div class="main" id="main">
    @yield('content')

    <div class="dashboard-footer">
        © {{ date('Y') }} Department of CSE, RTM-AKTU | Developed by SHIFAT | Batch: CSE-2
    </div>
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
