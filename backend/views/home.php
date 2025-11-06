<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enersave</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Color Palette based on Enersave Logo */
            --green-primary: #27ae60;
            --green-dark: #1e8449;
            --green-light: #2ecc71;
            --blue-primary: #3498db;
            --blue-dark: #2980b9;
            --blue-light: #5dade2;
            --white: #ffffff;
            --gray-light: #f5f7fa;
            --gray-medium: #e8ecf0;
            --gray-dark: #2c3e50;
            --text-primary: #2c3e50;
            --text-secondary: #5a6c7d;
            --success: #27ae60;
            --warning: #f39c12;
            --error: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, var(--gray-light) 0%, var(--gray-medium) 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--white);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 3px solid var(--green-primary);
        }

        .logo-container {
            display: inline-block;
            margin-bottom: 20px;
        }

        .logo {
            width: 120px;
            height: 120px;
            display: block;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--green-dark);
            margin-top: 20px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-top: 10px;
            font-weight: 400;
        }

        .info {
            background: linear-gradient(135deg, rgba(39, 174, 96, 0.1) 0%, rgba(52, 152, 219, 0.1) 100%);
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
            border-left: 4px solid var(--green-primary);
        }

        .info strong {
            color: var(--green-dark);
            font-weight: 600;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--green-dark);
            margin-top: 40px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--gray-medium);
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            margin: 12px 0;
            padding-left: 25px;
            position: relative;
        }

        li::before {
            content: "→";
            position: absolute;
            left: 0;
            color: var(--green-primary);
            font-weight: bold;
        }

        code {
            background: var(--gray-light);
            padding: 4px 8px;
            border-radius: 6px;
            font-family: 'Courier New', 'Consolas', monospace;
            font-size: 0.9em;
            color: var(--green-dark);
            border: 1px solid var(--gray-medium);
        }

        .endpoint {
            background: var(--gray-light);
            padding: 20px;
            margin: 15px 0;
            border-left: 5px solid var(--blue-primary);
            border-radius: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .endpoint:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .method {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-right: 12px;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.5px;
        }

        .method.get {
            background: var(--blue-primary);
            color: var(--white);
        }

        .method.post {
            background: var(--green-primary);
            color: var(--white);
        }

        .method.put {
            background: var(--warning);
            color: var(--white);
        }

        .method.delete {
            background: var(--error);
            color: var(--white);
        }

        a {
            color: var(--blue-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        a:hover {
            color: var(--green-primary);
            text-decoration: underline;
        }

        .status-badge {
            display: inline-block;
            background: var(--green-primary);
            color: var(--white);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .architecture-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .principle-card {
            background: var(--gray-light);
            padding: 15px;
            border-radius: 8px;
            border-left: 3px solid var(--blue-primary);
        }

        .principle-card strong {
            color: var(--green-dark);
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <svg class="logo" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <!-- Blue Arc -->
                    <path d="M 50 150 Q 100 100 150 50" stroke="#3498db" stroke-width="12" fill="none" stroke-linecap="round"/>
                    <path d="M 50 150 Q 100 100 150 50" stroke="#5dade2" stroke-width="8" fill="none" stroke-linecap="round"/>
                    
                    <!-- Green Shield -->
                    <path d="M 40 80 L 40 140 Q 40 160 60 160 L 80 160 Q 100 160 100 140 L 100 80 L 70 60 Z" fill="#1e8449"/>
                    <path d="M 45 80 L 45 135 Q 45 150 60 150 L 75 150 Q 90 150 90 135 L 90 80 L 70 65 Z" fill="#27ae60"/>
                    
                    <!-- Green Leaf -->
                    <ellipse cx="100" cy="100" rx="35" ry="50" fill="#27ae60" transform="rotate(-15 100 100)"/>
                    
                    <!-- White Lightning Bolt -->
                    <path d="M 95 70 L 105 70 L 98 100 L 108 100 L 95 140 L 105 140 L 112 110 L 102 110 Z" fill="#ffffff"/>
                </svg>
            </div>
            <h1>Enersave</h1>
            <p class="subtitle">Backend API Documentation</p>
        </div>
        
        <div class="info">
            <strong>Status:</strong> Server is running! <span class="status-badge">ACTIVE</span>
            <br>
            <strong>Version:</strong> <code>1.0.0</code>
            <br>
            <strong>Base URL:</strong> <code>http://<?php echo $_SERVER['HTTP_HOST']; ?></code>
            <br>
            <strong>API Endpoint:</strong> <code>/api</code>
        </div>

        <h2>📚 Quick Links</h2>
        <ul>
            <li><a href="example-usage.html">Test API (Interactive Example)</a></li>
            <li><a href="README.md">Backend Documentation</a></li>
            <li><a href="database/migrations/create_tables.sql">Database Schema</a></li>
        </ul>

        <h2>🔐 Authentication Endpoints</h2>
        
        <div class="endpoint">
            <span class="method post">POST</span>
            <code>/api/auth/register</code>
            <p>Register a new user</p>
        </div>
        
        <div class="endpoint">
            <span class="method post">POST</span>
            <code>/api/auth/login</code>
            <p>Login user</p>
        </div>

        <h2>🚀 Project Endpoints</h2>
        
        <div class="endpoint">
            <span class="method get">GET</span>
            <code>/api/projects</code>
            <p>Get all projects</p>
        </div>
        
        <div class="endpoint">
            <span class="method get">GET</span>
            <code>/api/projects/{id}</code>
            <p>Get project by ID</p>
        </div>
        
        <div class="endpoint">
            <span class="method post">POST</span>
            <code>/api/projects</code>
            <p>Create new project</p>
        </div>
        
        <div class="endpoint">
            <span class="method put">PUT</span>
            <code>/api/projects/{id}</code>
            <p>Update project</p>
        </div>
        
        <div class="endpoint">
            <span class="method delete">DELETE</span>
            <code>/api/projects/{id}</code>
            <p>Delete project</p>
        </div>
        
        <div class="endpoint">
            <span class="method get">GET</span>
            <code>/api/users/{userId}/projects</code>
            <p>Get user's projects</p>
        </div>

        <h2>📖 Quick Start</h2>
        <div class="info">
            <strong>1.</strong> Test the API using the <a href="example-usage.html">Interactive Example</a><br>
            <strong>2.</strong> Read the <a href="README.md">Backend Documentation</a> for details<br>
            <strong>3.</strong> Check the <a href="README.md">Quick Start Guide</a> for setup instructions
        </div>

        <h2>🏗️ Architecture</h2>
        <p>This backend is built following <strong>SOLID principles</strong>:</p>
        <div class="architecture-grid">
            <div class="principle-card">
                <strong>S</strong>ingle Responsibility Principle
            </div>
            <div class="principle-card">
                <strong>O</strong>pen/Closed Principle
            </div>
            <div class="principle-card">
                <strong>L</strong>iskov Substitution Principle
            </div>
            <div class="principle-card">
                <strong>I</strong>nterface Segregation Principle
            </div>
            <div class="principle-card">
                <strong>D</strong>ependency Inversion Principle
            </div>
        </div>

        <h2>🛠️ Technologies</h2>
        <ul>
            <li>PHP 7.4+</li>
            <li>MySQL/MariaDB</li>
            <li>PDO for Database Access</li>
            <li>RESTful API Design</li>
        </ul>
    </div>
</body>
</html>
