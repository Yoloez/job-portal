@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="login-container">
  <div class="login-wrapper">
    <div class="login-header">
      <h2>Sign in to your account</h2>
      <p>
        Or
        <a href="/register">create a new account</a>
      </p>
    </div>

    <form class="login-form" method="POST" action="/login">
      @csrf
      <input type="hidden" name="remember" value="true" />
      <div class="form-group">
        <div class="input-group">
          <label for="email">Email address</label>
          <input id="email" name="email" type="email" autocomplete="email" required placeholder="Email address">
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Password">
        </div>
      </div>
      <div class="options-row">
        <div class="remember-me">
          <input id="remember-me" name="remember-me" type="checkbox">
          <label for="remember-me">Remember me</label>
        </div>
      </div>
      <div>
        <button type="submit" class="btn-submit">Sign in</button>
      </div>
    </form>
  </div>
</div>

<style>
/* Container utama */
.login-container {
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f9fafb;
  padding: 3rem 1rem;
}

/* Wrapper konten login */
.login-wrapper {
  max-width: 28rem;
  width: 100%;
  margin: 0 auto;
}

/* Header teks login */
.login-header {
  margin-bottom: 2rem;
  text-align: center;
}

.login-header h2 {
  margin-top: 1.5rem;
  font-size: 1.875rem;
  line-height: 2.25rem;
  font-weight: 800;
  color: #111827;
}

.login-header p {
  margin-top: 0.5rem;
  font-size: 0.875rem;
  color: #6b7280;
}

.login-header a {
  font-weight: 500;
  color: #4f46e5;
  text-decoration: none;
}

/* Form login */
.login-form {
  margin-top: 2rem;
}

/* Grup input */
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

/* Opsi remember & forgot password */
.options-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.5rem;
}

.remember-me {
  display: flex;
  align-items: center;
}

.remember-me input[type="checkbox"] {
  height: 1rem;
  width: 1rem;
  accent-color: #4f46e5;
  border: 1px solid #d1d5db;
  border-radius: 0.25rem;
  background-color: #ffffff;
}

.remember-me label {
  margin-left: 0.5rem;
  font-size: 0.875rem;
  color: #111827;
}

.forgot-password a {
  font-size: 0.875rem;
  font-weight: 500;
  color: #4f46e5;
  text-decoration: none;
}

/* Tombol submit */
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
  cursor: pointer;
  outline: none;
  transition: background-color 0.2s;
}

.btn-submit:hover {
  background-color: #4338ca;
}
</style>
@endsection
