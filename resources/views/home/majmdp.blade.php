<x-default-layout title="Nouveau mot de passe">
<form action="{{ route('home.majmdp') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mt-10 mx-10 space-y-8 md:w-2/3">
        <x-input name="current_password" type="password" label="Mot de passe actuel" placeholder="Saisissez votre mot de passe actuel" />
        <x-input name="password" type="password" label="Nouveau mot de passe" placeholder="Saisissez votre nouveau mot de passe" />
        <x-input name="password_confirmation" type="password" label="Confirmation du nouveau mot de passe" placeholder="Confirmez votre nouveau mot de passe" />        
        </div>
        <div class="mt-12 ps-8">
                <button type="submit" class="shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Modifier
                </button>
              </div>
</form>
</x-default-layout>