@extends('layouts.admin.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment CRM Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
        }
        
        .dashboard-container { padding: 1.5rem; max-width: 1400px; margin: 0 auto; }
        
        /* Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .logo-title {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .header-actions { display: flex; align-items: center; gap: 0.75rem; }
        
        .search-input {
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            padding: 0.4rem 1rem;
            width: 200px;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .notification-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .notification-btn:hover { transform: translateY(-2px); }
        .notification-btn .material-icons { color: white; font-size: 20px; }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 0.4rem 1rem 0.4rem 0.4rem;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .avatar { width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.25rem 1rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--c1), var(--c2));
        }
        
        .stat-card:nth-child(1) { --c1: #4facfe; --c2: #00f2fe; }
        .stat-card:nth-child(2) { --c1: #43e97b; --c2: #38f9d7; }
        .stat-card:nth-child(3) { --c1: #fa709a; --c2: #fee140; }
        .stat-card:nth-child(4) { --c1: #30cfd0; --c2: #330867; }
        .stat-card:nth-child(5) { --c1: #a8edea; --c2: #fed6e3; }
        
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); }
        
        .stat-icon {
            width: 45px;
            height: 45px;
            margin: 0 auto 0.75rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--c1), var(--c2));
        }
        
        .stat-icon .material-icons { color: white; font-size: 1.5rem; }
        
        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--c1), var(--c2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        /* Content Cards */
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 1.25rem;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #4facfe);
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .card-title::before {
            content: '';
            width: 3px;
            height: 20px;
            background: linear-gradient(180deg, #667eea, #764ba2);
            border-radius: 10px;
        }
        
        /* Activity Feed */
        .activity-item {
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .activity-item:nth-child(1) { border-left-color: #4facfe; }
        .activity-item:nth-child(2) { border-left-color: #43e97b; }
        .activity-item:nth-child(3) { border-left-color: #fa709a; }
        .activity-item:nth-child(4) { border-left-color: #30cfd0; }
        
        .activity-item:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            transform: translateX(5px);
        }
        
        .activity-title { font-weight: 700; color: #1e293b; margin-bottom: 0.25rem; font-size: 0.9rem; }
        .activity-description { color: #64748b; margin-bottom: 0.25rem; font-size: 0.8rem; }
        .activity-time { font-size: 0.7rem; color: #94a3b8; font-weight: 600; text-transform: uppercase; }
        
        /* Table */
        .recruiter-table { width: 100%; font-size: 0.85rem; }
        .recruiter-table thead tr { background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1)); }
        .recruiter-table th { padding: 0.75rem 0.5rem; font-weight: 700; color: #475569; text-transform: uppercase; font-size: 0.7rem; }
        .recruiter-table td { padding: 0.75rem 0.5rem; border-bottom: 1px solid #e2e8f0; color: #1e293b; font-weight: 500; }
        .recruiter-table tbody tr { transition: all 0.3s ease; }
        .recruiter-table tbody tr:hover { background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05)); }
        
        .badge-number {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.75rem;
        }
        
        .badge-shortlisted { background: linear-gradient(135deg, #43e97b, #38f9d7); color: white; }
        .badge-joined { background: linear-gradient(135deg, #fa709a, #fee140); color: white; }
        
        /* DOJ Reminders */
        .doj-item {
            padding: 0.75rem;
            margin-bottom: 0.75rem;
            border-radius: 10px;
            background: white;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .doj-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, #667eea, #764ba2);
        }
        
        .doj-item:hover { border-color: #667eea; transform: translateX(5px); }
        .doj-candidate { font-weight: 700; color: #1e293b; margin-bottom: 0.25rem; font-size: 0.9rem; }
        .doj-client { color: #64748b; margin-bottom: 0.25rem; font-size: 0.8rem; }
        .doj-client::before { content: '🏢'; margin-right: 0.25rem; }
        .doj-date { color: #667eea; font-weight: 700; font-size: 0.8rem; }
        .doj-date::before { content: '📅'; margin-right: 0.25rem; }
        
        /* Chart Placeholder */
        .chart-placeholder {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 10px;
            border: 2px dashed #667eea;
        }
        
        .chart-placeholder-text { color: #667eea; font-weight: 700; font-size: 0.95rem; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container { padding: 1rem; }
            .top-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; padding: 1rem; }
            .header-actions { width: 100%; flex-wrap: wrap; }
            .search-input { width: 100%; }
            .stats-grid { grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 0.75rem; }
            .stat-card { padding: 1rem 0.75rem; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="top-header">
            <div class="logo-title">Recruitment CRM</div>
            <div class="header-actions">
                <!-- <input type="text" placeholder="Search…" class="search-input"> -->
                <button class="notification-btn">
                    <span class="material-icons">notifications</span>
                </button>
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=fff&color=667eea" class="avatar" alt="Admin">
                    <div>Admin</div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><span class="material-icons">person_add</span></div>
                <div class="stat-number">24</div>
                <div class="stat-label">Leads Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><span class="material-icons">check_circle</span></div>
                <div class="stat-number">12</div>
                <div class="stat-label">Shortlisted Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><span class="material-icons">event</span></div>
                <div class="stat-number">8</div>
                <div class="stat-label">Interviews Today</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><span class="material-icons">thumb_up</span></div>
                <div class="stat-number">15</div>
                <div class="stat-label">Selections This Month</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><span class="material-icons">celebration</span></div>
                <div class="stat-number">10</div>
                <div class="stat-label">Joins This Month</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Activity Feed -->
            <div class="col-lg-8 mb-3">
                <div class="content-card">
                    <h3 class="card-title">Activity Feed</h3>
                    <div class="activity-item">
                        <div class="activity-title">🎯 New Lead: John Doe</div>
                        <div class="activity-description">Applied for Senior Developer position</div>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-title">📅 Interview Scheduled</div>
                        <div class="activity-description">Sarah Smith - Frontend Developer at TechCorp</div>
                        <div class="activity-time">4 hours ago</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-title">🎉 Candidate Joined</div>
                        <div class="activity-description">Michael Johnson started at Innovate Labs</div>
                        <div class="activity-time">1 day ago</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-title">✅ Selection Confirmed</div>
                        <div class="activity-description">Emma Wilson selected for Project Manager role</div>
                        <div class="activity-time">2 days ago</div>
                    </div>
                </div>
            </div>

            <!-- Top Performers -->
            <div class="col-lg-4 mb-3">
                <div class="content-card">
                    <h3 class="card-title">Top Performers</h3>
                    <table class="recruiter-table">
                        <thead>
                            <tr>
                                <th class="text-left">Recruiter</th>
                                <th class="text-center">Shortlisted</th>
                                <th class="text-center">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>👤 Alice Brown</td>
                                <td class="text-center"><span class="badge-number badge-shortlisted">45</span></td>
                                <td class="text-center"><span class="badge-number badge-joined">12</span></td>
                            </tr>
                            <tr>
                                <td>👤 Bob Wilson</td>
                                <td class="text-center"><span class="badge-number badge-shortlisted">38</span></td>
                                <td class="text-center"><span class="badge-number badge-joined">10</span></td>
                            </tr>
                            <tr>
                                <td>👤 Carol Davis</td>
                                <td class="text-center"><span class="badge-number badge-shortlisted">32</span></td>
                                <td class="text-center"><span class="badge-number badge-joined">8</span></td>
                            </tr>
                            <tr>
                                <td>👤 David Lee</td>
                                <td class="text-center"><span class="badge-number badge-shortlisted">28</span></td>
                                <td class="text-center"><span class="badge-number badge-joined">7</span></td>
                            </tr>
                            <tr>
                                <td>👤 Eva Martinez</td>
                                <td class="text-center"><span class="badge-number badge-shortlisted">25</span></td>
                                <td class="text-center"><span class="badge-number badge-joined">6</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="row">
            <!-- DOJ Reminders -->
            <div class="col-lg-6 mb-3">
                <div class="content-card">
                    <h3 class="card-title">Upcoming DOJ Reminders</h3>
                    <div class="doj-item">
                        <div class="doj-candidate">James Anderson</div>
                        <div class="doj-client">Client: Microsoft</div>
                        <div class="doj-date">DOJ: December 15, 2025</div>
                    </div>
                    <div class="doj-item">
                        <div class="doj-candidate">Lisa Thompson</div>
                        <div class="doj-client">Client: Google</div>
                        <div class="doj-date">DOJ: December 18, 2025</div>
                    </div>
                    <div class="doj-item">
                        <div class="doj-candidate">Robert Garcia</div>
                        <div class="doj-client">Client: Amazon</div>
                        <div class="doj-date">DOJ: December 20, 2025</div>
                    </div>
                </div>
            </div>

            <!-- Revenue Chart -->
            <div class="col-lg-6 mb-3">
                <div class="content-card">
                    <h3 class="card-title">Revenue vs Expense</h3>
                    <div class="chart-placeholder">
                        <div class="chart-placeholder-text">Chart will load here</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection