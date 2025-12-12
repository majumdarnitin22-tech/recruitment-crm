<!-- FIXED ADMIN PANEL HEADER -->
<div class="main-navbar">

    <!-- LEFT LOGO -->
    <div class="logo">Admin Portal</div>

    <!-- CENTER MENU -->
    <ul class="center-menu">
        <li><a href="/admin/dashboard">Dashboard</a></li>
        <li><a href="/admin/leads">Leads</a></li>
        <li><a href="{{ route('admin.clients') }}">Clients</a></li>
        <li><a href="{{ route('admin.recruiters') }}">Recruiters</a></li>
        <li><a href="/users/view">Users</a></li>
        <li><a href="{{ route('users.create') }}">Add User</a></li>
        <li><a href="{{ route('admin.candidates.add') }}">Add Candidates</a></li>
    </ul>

    <!-- RIGHT MENU -->
    <div class="right-menu">
        <div class="notification">🔔</div>

        <!-- Profile -->
        <div class="profile-container">
            <div class="profile-name" onclick="toggleProfileMenu()">
                👤 Admin ▼
            </div>

            <!-- Dropdown -->
            <ul id="profileMenu">
                <li><a href="/admin/profile">👤 My Profile</a></li>
                <li><a href="/admin/activity">📄 Activity Logs</a></li>
                <li><a href="/admin/settings">⚙️ Settings</a></li>
                <li><a href="/logout" class="logout">🚪 Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<script>
    function toggleProfileMenu() {
        let menu = document.getElementById("profileMenu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }
</script>

<!-- Add spacing so content goes below fixed header -->
<div style="height: 80px;"></div>

<style>
/* MAIN NAVBAR */
.main-navbar {
    width: 100%;
    height: 45px; /* Fixed height */
    background: rgba(255,255,255,0.95);
    padding: 0 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    border-bottom: 1px solid #e3e3e3;
    backdrop-filter: blur(12px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    z-index: 9999;
    transition: all 0.3s ease;
}

/* LOGO */
.logo {
    font-weight: 800;
    background: linear-gradient(135deg,#667eea,#764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* CENTER MENU */
.center-menu {
    display: flex;
    list-style: none;
    gap: 45px; /* spacing between items */
    margin: 0;
    padding: 0;
    align-items: center;
    flex: 1;
    justify-content: center;
}

.center-menu li a {
    text-decoration: none;
    font-weight: 600;
    color: #333;
    position: relative;
    transition: all 0.3s ease;
}

.center-menu li a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg,#667eea,#764ba2);
    left: 0;
    bottom: -5px;
    transition: all 0.3s ease;
}

.center-menu li a:hover::after {
    width: 100%;
}

/* RIGHT MENU */
.right-menu {
    display: flex;
    align-items: center;
    gap: 25px; /* spacing between notification and profile */
}

/* PROFILE */
.profile-container {
    position: relative;
    cursor: pointer;
}

.profile-name {
    font-weight: 600;
    color: #333;
    transition: all 0.3s ease;
}

.profile-name:hover {
    color: #667eea;
}

/* DROPDOWN MENU */
#profileMenu {
    display: none;
    position: absolute;
    right: 0;
    top: 30px;
    background: #fff;
    padding: 10px 0;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    width: 190px;
    list-style: none;
    margin: 0;
    z-index: 100;
}

#profileMenu li {
    padding: 12px 22px;
}

#profileMenu li a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    display: block;
    transition: all 0.2s ease;
}

#profileMenu li a:hover {
    background: rgba(102,126,234,0.1);
    color: #667eea;
    border-radius: 8px;
}

/* LOGOUT LINK */
#profileMenu li a.logout:hover {
    background: rgba(250,112,154,0.1);
    color: #d00;
}

/* NOTIFICATIONS */
.notification {
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification:hover {
    transform: scale(1.1);
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .center-menu {
        gap: 20px;
    }
    .main-navbar {
        padding: 0 20px;
    }
}

@media (max-width: 768px) {
    .center-menu {
        display: none;
    }
}
</style>
