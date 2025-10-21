<div style="display: flex; flex-direction: row; justify-content: space-evenly; align-items: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px 40px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255, 255, 255, 0.1); position: relative; overflow: hidden;">
    <!-- Decorative gradient overlay -->
    <div style="position: absolute; top: -50%; right: -10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50%; left: -10%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none;"></div>
    
    <a href="/" style="text-decoration: none; color: {{ request()->is('/') ? '#667eea' : 'white' }}; padding: 12px 28px; border-radius: 12px; transition: all 0.3s ease; position: relative; overflow: hidden; background: {{ request()->is('/') ? 'white' : 'rgba(255, 255, 255, 0.1)' }}; backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <h1 style="margin: 0; font-size: 18px; font-weight: {{ request()->is('/') ? '700' : '600' }}; letter-spacing: 0.5px; text-shadow: {{ request()->is('/') ? 'none' : '0 2px 10px rgba(0, 0, 0, 0.2)' }};">Home</h1>
    </a>
    
    <a href="/about" style="text-decoration: none; color: {{ request()->is('about') ? '#667eea' : 'white' }}; padding: 12px 28px; border-radius: 12px; transition: all 0.3s ease; position: relative; overflow: hidden; background: {{ request()->is('about') ? 'white' : 'rgba(255, 255, 255, 0.1)' }}; backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <h1 style="margin: 0; font-size: 18px; font-weight: {{ request()->is('about') ? '700' : '600' }}; letter-spacing: 0.5px; text-shadow: {{ request()->is('about') ? 'none' : '0 2px 10px rgba(0, 0, 0, 0.2)' }};">About</h1>
    </a>
    
    <a href="/login" style="text-decoration: none; color: {{ request()->is('login') ? '#667eea' : 'white' }}; padding: 12px 28px; border-radius: 12px; transition: all 0.3s ease; position: relative; overflow: hidden; background: {{ request()->is('login') ? 'white' : 'rgba(255, 255, 255, 0.1)' }}; backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <h1 style="margin: 0; font-size: 18px; font-weight: {{ request()->is('login') ? '700' : '600' }}; letter-spacing: 0.5px; text-shadow: {{ request()->is('login') ? 'none' : '0 2px 10px rgba(0, 0, 0, 0.2)' }};">Login</h1>
    </a>
    
    <a href="/register" style="text-decoration: none; color: {{ request()->is('register') ? '#667eea' : 'white' }}; padding: 12px 28px; border-radius: 12px; transition: all 0.3s ease; background: {{ request()->is('register') ? 'white' : 'rgba(255, 255, 255, 0.1)' }}; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); border: {{ request()->is('register') ? '2px solid #667eea' : '1px solid rgba(255, 255, 255, 0.2)' }};">
        <h1 style="margin: 0; font-size: 18px; font-weight: 700; letter-spacing: 0.5px; text-shadow: {{ request()->is('register') ? 'none' : '0 2px 10px rgba(0, 0, 0, 0.2)' }};">Register</h1>
    </a>
</div>