<x-guest-layout>
    <form action="{{route('two-factor.verify')}}" method="post">
        @csrf
        <label for="code">Two Factor code</label>
        <input type="text" id="code" name="code"><br>
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        <button type="submit">Verify</button>
    </form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</x-guest-layout>