<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Kelola User</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-4">

        <table class="min-w-full bg-white border">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($user->role) }}</td>
                        <td class="px-4 py-2 border flex gap-2">
                            <a href="{{ route('users.edit', $user->id) }}"><button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Edit</button></a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm"
                                    onclick="return confirm('Yakin hapus user?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
