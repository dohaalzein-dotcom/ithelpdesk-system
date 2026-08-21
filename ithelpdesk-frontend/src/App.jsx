import { useEffect, useState } from 'react'
import './App.css'

function App() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [message, setMessage] = useState('')
  const [user, setUser] = useState(null)
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    const token = localStorage.getItem('token')

    if (token) {
      getUser(token)
    }
  }, [])

  const getUser = async (token) => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/me', {
        headers: {
          Accept: 'application/json',
          Authorization: `Bearer ${token}`,
        },
      })

      const data = await response.json()

      if (response.ok) {
        setUser(data)
      } else {
        localStorage.removeItem('token')
      }
    } catch (error) {
      console.error(error)
    }
  }

  const handleLogin = async (e) => {
    e.preventDefault()

    setLoading(true)
    setMessage('')

    try {
      const response = await fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
        },
        body: JSON.stringify({
          Email: email,
          Password: password,
        }),
      })

      const data = await response.json()

      if (!response.ok) {
        setMessage(data.message || 'Invalid credentials')
        return
      }

      localStorage.setItem('token', data.token)

      setMessage('')
      setUser(data.user || null)

      if (!data.user) {
        await getUser(data.token)
      }
    } catch (error) {
      setMessage('Cannot connect to Laravel API')
      console.error(error)
    } finally {
      setLoading(false)
    }
  }

  const handleLogout = () => {
    localStorage.removeItem('token')
    setUser(null)
    setEmail('')
    setPassword('')
  }

  if (user) {
    return (
      <div className="app">
        <header className="navbar">
          <div className="brand">
            <div className="brand-icon">IT</div>
            <div>
              <h2>IT Help Desk</h2>
              <span>Support Management System</span>
            </div>
          </div>

          <button className="logout-button" onClick={handleLogout}>
            Logout
          </button>
        </header>

        <main className="dashboard">
          <div className="welcome">
            <span className="welcome-label">DASHBOARD</span>
            <h1>Welcome back! 👋</h1>
            <p>
              You are successfully logged in to the IT Help Desk system.
            </p>
          </div>

          <div className="cards">
            <div className="info-card">
              <div className="card-icon">👤</div>
              <div>
                <span>User</span>
                <strong>
                  {user.Username || 'User'}
                </strong>
              </div>
            </div>

            <div className="info-card">
              <div className="card-icon">✉️</div>
              <div>
                <span>Email</span>
                <strong>
                  {user.Email || user.email || 'Not available'}
                </strong>
              </div>
            </div>

            <div className="info-card">
              <div className="card-icon">🔐</div>
              <div>
                <span>Role ID</span>
                <strong>{user.RoleId ?? 'Not available'}</strong>
              </div>
            </div>
          </div>

          <section className="quick-actions">
            <h2>Quick Access</h2>

            <div className="action-grid">
              <div className="action-card">
                <span>🎫</span>
                <h3>My Tickets</h3>
                <p>View and manage your support tickets.</p>
              </div>

              <div className="action-card">
                <span>📋</span>
                <h3>Support Requests</h3>
                <p>Track your IT support requests.</p>
              </div>

              <div className="action-card">
                <span>⚙️</span>
                <h3>Account Settings</h3>
                <p>Manage your account information.</p>
              </div>
            </div>
          </section>
        </main>
      </div>
    )
  }

  return (
    <div className="login-page">
      <div className="login-decoration">
        <div className="circle circle-one"></div>
        <div className="circle circle-two"></div>

        <div className="login-brand">
          <div className="big-icon">IT</div>
          <h1>IT Help Desk</h1>
          <p>
            Fast and reliable IT support management for your organization.
          </p>
        </div>
      </div>

      <div className="login-area">
        <div className="login-card">
          <div className="mobile-logo">IT</div>

          <span className="login-label">WELCOME BACK</span>
          <h1>Sign in</h1>
          <p className="login-description">
            Enter your account details to continue.
          </p>

          <form onSubmit={handleLogin}>
            <div className="input-group">
              <label>Email Address</label>
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="Enter your email"
                required
              />
            </div>

            <div className="input-group">
              <label>Password</label>
              <input
                type="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="Enter your password"
                required
              />
            </div>

            <button
              className="login-button"
              type="submit"
              disabled={loading}
            >
              {loading ? 'Signing in...' : 'Sign In'}
            </button>
          </form>

          {message && (
            <div className="error-message">
              {message}
            </div>
          )}

          <p className="login-footer">
            IT Help Desk Management System
          </p>
        </div>
      </div>
    </div>
  )
}

export default App