@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="register-container">
  <div class="register-wrapper">
    <div class="register-header">
      <h2>Create your account</h2>
      <p>
        Or
        <a href="/login">sign in to your account</a>
      </p>
    </div>

    <form class="register-form" method="POST" action="/register">
      @csrf
      <div class="form-group">
        <div class="input-group">
          <label for="name">Full Name</label>
          <input id="name" name="name" type="text" autocomplete="name" required placeholder="Full Name">
        </div>
        <div class="input-group">
          <label for="email">Email address</label>
          <input id="email" name="email" type="email" autocomplete="email" required placeholder="Email address">
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="Password">
        </div>
        <div class="input-group">
          <label for="password_confirmation">Confirm Password</label>
          <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required placeholder="Confirm Password">
        </div>
        <div class="role-group">
          <span>Select Role</span>
          <div class="role-options">
            <label><input type="radio" name="role" value="user" checked> User</label>
            <label><input type="radio" name="role" value="admin"> Admin</label>
          </div>
        </div>
      </div>
      <div>
        <button type="submit" class="btn-submit">Create Account</button>
      </div>
    </form>
  </div>
</div>

<style>
.register-container {
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f9fafb;
  padding: 3rem 1rem;
}

.register-wrapper {
  max-width: 28rem;
  width: 100%;
  margin: 0 auto;
}

.register-header {
  margin-bottom: 2rem;
  text-align: center;
}

.register-header h2 {
  margin-top: 1.5rem;
  font-size: 1.875rem;
  line-height: 2.25rem;
  font-weight: 800;
  color: #111827;
}

.register-header p {
  margin-top: 0.5rem;
  font-size: 0.875rem;
  color: #6b7280;
}

.register-header a {
  font-weight: 500;
  color: #4f46e5;
  text-decoration: none;
}

.register-form {
  margin-top: 2rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.input-group {
  margin-bottom: 1rem;
}

.input-group label {
  display: block;
  font-size: 0.875rem;
  font-weight: 500;
  color: #374151;
  margin-bottom: 0.5rem;
}

.input-group input {
  display: block;
  width: 100%;
  padding: 0.5rem 0.75rem;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
  background-color: #ffffff;
  color: #111827;
  font-size: 0.875rem;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  outline: none;
}

.input-group input:focus {
  border-color: #4f46e5;
  box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
}

.role-group {
  margin-top: 1rem;
}

.role-group span {
  display: block;
  font-size: 0.875rem;
  font-weight: 500;
  color: #374151;
  margin-bottom: 0.5rem;
}

.role-options {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.role-options label {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  font-size: 0.875rem;
  color: #374151;
}

.role-options input[type="radio"] {
  accent-color: #4f46e5;
}

.btn-submit {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  padding: 0.5rem 1rem;
  border: 1px solid transparent;
  border-radius: 0.375rem;
  background-color: #4f46e5;
  color: #ffffff;
  font-size: 0.875rem;
  font-weight: 500;
  text-decoration: none;
  cursor: pointer;
  outline: none;
  transition: background-color 0.2s;
}

.btn-submit:hover {
  background-color: #4338ca;
}
</style>
@endsection
