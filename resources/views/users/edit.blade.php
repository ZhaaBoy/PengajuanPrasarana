<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="form-input w-full mt-1 rounded-md shadow-sm border-gray-300" required>
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="form-input w-full mt-1 rounded-md shadow-sm border-gray-300" required>
                @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" class="form-select w-full mt-1 rounded-md border-gray-300" required>
                    <option value="guru" {{ $user->role === 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="kepala_sekolah" {{ $user->role === 'kepala_sekolah' ? 'selected' : '' }}>Kepala
                        Sekolah</option>
                    <option value="administrasi" {{ $user->role === 'administrasi' ? 'selected' : '' }}>Administrasi
                    </option>
                </select>
                @error('role')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Baru -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password Baru (opsional)</label>
                <input type="password" name="password" class="form-input w-full mt-1 rounded-md border-gray-300">
                @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="form-input w-full mt-1 rounded-md border-gray-300">
            </div>

            <!-- Submit -->
            <div class="flex justify-between mt-6">
                <x-button>Simpan Perubahan</x-button>
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
            </div>
        </form>
    </div>
</x-app-layout>
