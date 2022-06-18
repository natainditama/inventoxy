@extends('layouts.app')
@section('content')
<div class="w-full h-full grid place-items-center py-20">
	<div class="flex flex-col max-w-[20rem] w-full gap-4 text-center">
		<h1 class="font-bold text-4xl">Sign In</h1>
		<p>Sign in to access your account</p>
		<form action="{{ $route }}" method="post" class="text-left mt-2">
			@csrf
			<div class="flex flex-col gap-2 mb-4">
				<label for="email" class="font-medium">Email</label>
				<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 rounded-lg focus:border-blue-500 block w-full p-2.5" value="{{ old('email') }}" placeholder="Enter your email address">
				@if ($errors->has('email'))
				<p class="text-red-500 text-sm italic">{{ $errors->first('email') }}</p>
				@endif
			</div>
			<div class="flex flex-col gap-2 mb-4">
				<label for="password" class="font-medium">Password</label>
				<input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 rounded-lg focus:border-blue-500 block w-full p-2.5" value="{{ old('password') }}" placeholder="Enter your password">
				@if ($errors->has('password'))
				<p class="text-red-500 text-sm italic">{{ $errors->first('password') }}</p>
				@endif
			</div>
			<div class="flex flex-col gap-2 mb-4">
				<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg px-5 py-3">Sign In</button>
				<p class="text-center mt-4">
					Don't have an account yet?
					<a href="{{route('signup')}}" class="text-blue-600 hover:underline">Sign up</a>.
				</p>
			</div>
		</form>
	</div>
</div>
@endsection