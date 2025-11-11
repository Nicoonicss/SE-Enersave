<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explore · Enersave</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header class="site-header">
        <div class="inner">
            <div class="brand"><img src="/images/logo.png" alt="logo"><span class="name">Enersave</span></div>
            <nav class="nav">
                <a class="active" href="/explore">Explore</a>
                <a href="/community">Community</a>
                <a href="/project_support">Projects</a>
                <a href="/admin">Admin</a>
                <a href="/logout">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container">
        <h1>Explore Sustainable Products & Suppliers</h1>
        <div class="grid">
            <div class="card row-span-12">
                <form class="grid" method="get">
                    <div class="field row-span-6">
                        <label for="q">Search</label>
                        <input id="q" type="text" name="q" placeholder="Search products or suppliers">
                    </div>
                    <div class="field row-span-4">
                        <label for="cat">Category</label>
                        <select id="cat" name="category">
                            <option value="">All</option>
                            <option>Solar</option>
                            <option>Wind</option>
                            <option>Hydro</option>
                        </select>
                    </div>
                    <div class="row-span-2" style="display:flex;align-items:flex-end;gap:10px;">
                        <button class="btn primary" type="submit">Filter</button>
                        <a class="btn ghost" href="/explore">Reset</a>
                    </div>
                </form>
            </div>
            <div class="card row-span-12">
                <p class="muted">Results will appear here. If none, you'll see "No results found".</p>
                <table class="table">
                    <thead><tr><th>Product</th><th>Supplier</th><th>Category</th><th>Price</th></tr></thead>
                    <tbody>
                        <tr><td>—</td><td>—</td><td>—</td><td>—</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

