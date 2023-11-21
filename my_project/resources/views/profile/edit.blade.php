 <h1>Edit Profile</h1>

    <form method="post" action="{{ route('profile.update', $user) }}">
        @csrf
        @method('put')

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>

        <button type="submit">Update Profile</button>
    </form>

