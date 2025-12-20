@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="register-container">
  <div class="register-wrapper">
    <div class="register-header">
      <h2>Create Account</h2>
      <p>Already have an account? <a href="/login">Sign in</a></p>
    </div>

    <form class="register-form" method="POST" action="/register">
      @csrf
      <div class="form-group">
        <div class="input-group">
          <label for="name">Full Name</label>
          <input id="name" name="name" type="text" autocomplete="name" required placeholder="Enter your full name">
        </div>
        
        <div class="input-group">
          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" autocomplete="email" required placeholder="Enter your email">
        </div>
        
        <div class="input-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="Create a password">
        </div>
        
        <div class="input-group">
          <label for="password_confirmation">Confirm Password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="Confirm your password">
        </div>
        
        <div class="role-group">
          <label class="role-label">Account Type</label>
          <div class="role-options">
            <label class="role-option">
              <input type="radio" name="role" value="user" checked>
              <span class="role-text">User</span>
            </label>
            <label class="role-option">
              <input type="radio" name="role" value="admin">
              <span class="role-text">Admin</span>
            </label>
          </div>
        </div>
      </div>
      
      <button type="submit" class="btn-submit">Create Account</button>
    </form>
  </div>
</div>

<style>
.register-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  padding: 48px 24px;
}

.register-wrapper {
  max-width: 440px;
  width: 100%;
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  padding: 40px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

/* Header */
.register-header {
  margin-bottom: 32px;
  text-align: center;
}

.register-header h2 {
  font-size: 24px;
  font-weight: 600;
  color: #111827;
  margin-bottom: 8px;
  letter-spacing: -0.3px;
}

.register-header p {
  font-size: 14px;
  color: #6b7280;
  margin: 0;
}

.register-header a {
  color: #111827;
  text-decoration: none;
  font-weight: 500;
  border-bottom: 1px solid #111827;
  transition: all 0.2s ease;
}

.register-header a:hover {
  color: #000000;
  border-bottom-color: #000000;
}

/* Form */
.register-form {
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

/* Role Selection */
.role-group {
  display: flex;
  flex-direction: column;
}

.role-label {
  font-size: 14px;
  font-weight: 500;
  color: #111827;
  margin-bottom: 12px;
}

.role-options {
  display: flex;
  gap: 12px;
}

.role-option {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 16px;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  background: #ffffff;
  cursor: pointer;
  transition: all 0.2s ease;
}

.role-option:hover {
  border-color: #d1d5db;
  background: #f9fafb;
}

.role-option input[type="radio"] {
  width: 16px;
  height: 16px;
  margin: 0;
  cursor: pointer;
  accent-color: #000000;
}

.role-option input[type="radio"]:checked + .role-text {
  font-weight: 600;
}

.role-option:has(input[type="radio"]:checked) {
  border-color: #000000;
  background: #f9fafb;
}

.role-text {
  font-size: 14px;
  color: #4b5563;
  font-weight: 500;
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
  margin-top: 8px;
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
  .register-wrapper {
    padding: 32px 24px;
  }
  
  .register-header h2 {
    font-size: 22px;
  }
  
  .role-options {
    flex-direction: column;
  }
}
</style>
@endsection