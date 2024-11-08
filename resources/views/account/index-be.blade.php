
    {{-- Page Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('account.search')}}" method="get">
                        <input type="text" id="search" name="search">
                        <button type="submit">search</button>
                    </form>
                    {{-- Users Table --}}
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-gray-300 md:border-none md:table-row">
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">ID</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Name</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Username</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Email</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Email Verified At</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Is Two-Factor</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Photo</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Provider</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Role ID</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">suspend until</th>
                                <th class="p-2 text-left md:border md:border-gray-300 block md:table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @foreach($users as $user)
                                <tr class="border border-gray-300 md:border-none md:table-row">
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->id }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->name }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->username }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->email }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                        {{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i') : __('Not Verified') }}
                                    </td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                        {{ $user->is_twoFactor ? __('Enabled') : __('Disabled') }}
                                    </td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                        @if($user->photo)
                                            <img src="{{ $user->photo }}" alt="User Photo" width="50" height="50" class="rounded-full">
                                        @else
                                            {{ __('N/A') }}
                                        @endif
                                    </td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->provider }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->role_id }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $user->suspend_until }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                        <form action="{{route('account.suspend')}}" method="post">
                                            @csrf
                                            <input type="text" value="{{$user->id}}" name="id" hidden>
                                            <button type="submit">suspend</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
