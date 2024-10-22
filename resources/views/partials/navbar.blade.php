<!-- resources/views/partials/navbar.blade.php -->
<nav>
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>

        <!-- Check if the user is authenticated -->
        @guest
            <!-- Show these links if the user is not logged in -->
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <!-- Show user information and logout link if the user is logged in -->
            <li>
                <span>Welcome, {{ Auth::user()->name }}</span>
            </li>
            <li>
                <!-- Logout form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endguest
    </ul>
</nav>

