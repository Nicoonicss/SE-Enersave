<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Enersave</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-primary: #27ae60;
            --green-dark: #1e8449;
            --blue-primary: #3498db;
            --white: #ffffff;
            --gray-light: #f5f7fa;
            --text-primary: #2c3e50;
            --text-secondary: #5a6c7d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--gray-light) 0%, #e8ecf0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-primary);
        }

        .container {
            text-align: center;
            background: var(--white);
            padding: 60px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            display: block;
        }

        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            color: var(--green-dark);
            margin-bottom: 20px;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        p {
            color: var(--text-secondary);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            background: var(--green-primary);
            color: var(--white);
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        a:hover {
            background: var(--green-dark);
        }
    </style>
</head>
<body>
    <div class="container">
        <svg class="logo" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M 50 150 Q 100 100 150 50" stroke="#3498db" stroke-width="12" fill="none" stroke-linecap="round"/>
            <path d="M 50 150 Q 100 100 150 50" stroke="#5dade2" stroke-width="8" fill="none" stroke-linecap="round"/>
            <path d="M 40 80 L 40 140 Q 40 160 60 160 L 80 160 Q 100 160 100 140 L 100 80 L 70 60 Z" fill="#1e8449"/>
            <path d="M 45 80 L 45 135 Q 45 150 60 150 L 75 150 Q 90 150 90 135 L 90 80 L 70 65 Z" fill="#27ae60"/>
            <ellipse cx="100" cy="100" rx="35" ry="50" fill="#27ae60" transform="rotate(-15 100 100)"/>
            <path d="M 95 70 L 105 70 L 98 100 L 108 100 L 95 140 L 105 140 L 112 110 L 102 110 Z" fill="#ffffff"/>
        </svg>
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>The page you're looking for doesn't exist or has been moved.</p>
        <a href="/">Go Back Home</a>
    </div>
</body>
</html>
