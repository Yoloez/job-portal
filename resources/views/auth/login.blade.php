@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="login-container">
  <div class="login-wrapper">
    <div class="login-header">
      <h2>Sign In</h2>
      <p>Don't have an account? <a href="/register">Create one</a></p>
    </div>

    <form class="login-form" method="POST" action="/login">
      @csrf
      <input type="hidden" name="remember" value="true" />
      <div class="form-group">
        <div class="input-group">
          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" autocomplete="email" required placeholder="Enter your email">
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Enter your password">
        </div>
      </div>
      
      <div class="options-row">
        <label class="remember-me">
          <input id="remember-me" name="remember-me" type="checkbox">
          <span class="remember-text">Remember me</span>
        </label>
      </div>
      
      <button type="submit" class="btn-submit">Sign In</button>
    </form>
  </div>
</div>

<style>
.login-container {
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  padding: 48px 24px;
}

.login-wrapper {
  max-width: 440px;
  width: 100%;
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

/* Header */
.login-header {
  margin-bottom: 32px;
  text-align: center;
}

.login-header h2 {
  font-size: 24px;
  font-weight: 600;
  color: #111827;
  margin-bottom: 8px;
  letter-spacing: -0.3px;
}

.login-header p {
  font-size: 14px;
  color: #6b7280;
  margin: 0;
}

.login-header a {
  color: #111827;
  text-decoration: none;
  font-weight: 500;
  border-bottom: 1px solid #111827;
  transition: all 0.2s ease;
}

.login-header a:hover {
  color: #000000;
  border-bottom-color: #000000;
}

/* Form */
.login-form {
  margin-top: 24px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-bottom: 24px;
}

.input-group {
  display: flex;
  flex-direction: column;
}

.input-group label {
  font-size: 14px;
  font-weight: 500;
  color: #111827;
  margin-bottom: 8px;
}

.input-group input {
  width: 100%;
  padding: 12px 16px;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  background: #ffffff;
  color: #111827;
  font-size: 14px;
  outline: none;
  transition: all 0.2s ease;
}

.input-group input::placeholder {
  color: #9ca3af;
}

.input-group input:focus {
  border-color: #000000;
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
}

/* Options Row */
.options-row {
  margin-bottom: 24px;
}

.remember-me {
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
}

.remember-me input[type="checkbox"] {
  width: 16px;
  height: 16px;
  margin: 0;
  cursor: pointer;
  accent-color: #000000;
  border: 1px solid #e5e7eb;
  border-radius: 4px;
}

.remember-text {
  font-size: 14px;
  color: #4b5563;
  font-weight: 500;
  user-select: none;
}

/* Submit Button */
.btn-submit {
  width: 100%;
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  background: #000000;
  color: #ffffff;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-submit:hover {
  background: #1f2937;
  transform: translateY(-1px);
}

.btn-submit:active {
  transform: translateY(0);
}

/* Responsive */
@media (max-width: 480px) {
  .login-wrapper {
    padding: 32px 24px;
  }
  
  .login-header h2 {
    font-size: 22px;
  }
}
</style>
@endsection