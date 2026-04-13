<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Perpustakaan Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --secondary-color: #ec4899;
            --secondary-hover: #db2777;
            --dark-color: #0f172a;
            /* --body-bg: #f1f5f9;  Removed in favor of gradient */
            --sidebar-bg: rgba(30, 41, 59, 0.7);
            --card-bg: rgba(255, 255, 255, 0.8);
            --text-color: #334155;
            --text-muted: #64748b;
            --border-color: rgba(255, 255, 255, 0.5);
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            color: var(--text-color);
            background-color: #eef2f5;
            background-image:
                radial-gradient(at 0% 0%, hsla(253, 16%, 7%, 1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(225, 39%, 30%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(339, 49%, 30%, 1) 0, transparent 50%);
            background-size: 200% 200%;
            animation: gradient-animation 15s ease infinite;
            background-attachment: fixed;
            /* Fix bg for scrolling */
            position: relative;
            /* overflow-x: hidden; Allow scroll but hide overflow x */
        }

        /* Abstract shapes */
        .shape {
            position: fixed;
            /* Fixed so they stay in place during scroll */
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: #4f46e5;
            top: -100px;
            left: -100px;
            animation: moveShape1 10s infinite alternate;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: #ec4899;
            bottom: -50px;
            right: -50px;
            animation: moveShape2 12s infinite alternate;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background: #06b6d4;
            top: 40%;
            left: 20%;
            animation: moveShape3 15s infinite alternate;
        }

        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes moveShape1 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(50px, 50px);
            }
        }

        @keyframes moveShape2 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-30px, -60px);
            }
        }

        @keyframes moveShape3 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(100px, -20px);
            }
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
            /* Above background */
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid var(--border-color);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 2rem 1.5rem;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: var(--glass-shadow);
        }

        .sidebar-header .logo {
            font-size: 3rem;
            color: white;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .sidebar-header h4 {
            color: white;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .user-info {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .user-info .badge {
            background: var(--primary-color) !important;
            font-weight: 500;
            margin-top: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .nav-link {
            color: #cbd5e1;
            padding: 14px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active {
            color: white;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
            width: calc(100% - 280px);
        }

        /* Cards */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: var(--glass-shadow);
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.5);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 1.1rem;
        }

        /* Tables override for glass */
        .table thead th {
            background: rgba(248, 250, 252, 0.5);
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody td {
            border-bottom: 1px solid var(--border-color);
        }

        .table-responsive {
            border: 1px solid var(--border-color);
        }

        /* Inputs override */
        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.8);
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--glass-shadow);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.9);
        }

        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-card .value {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-color);
        }

        .stat-card .label {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>