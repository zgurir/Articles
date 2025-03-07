<x-default-layout title="Informations personnelles">

    <form action="{{ route('home.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-12 mx-10">
          <div class="border-b border-gray-900/10 pb-12">
            <div x-data class="flex justify-between pb-0"> {{--justify-between en combinaison avec flex permet de coller h2 à l'extrémité gauche du conteneur et button à l'extrémité droite --}}
            <h2 class="text-base/7 font-semibold text-gray-900">Profile</h2>
            <button @click="window.location.href='{{ route('home.majmdp')}}'" type="button" id="createProductButton" data-modal-toggle="createProductModal" class="flex items-center justify-center mr-2 text-white bg-cyan-600 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-0 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Changer votre mot de passe
            </button>
        </div>
            <p class="text-sm/6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="relative sm:col-span-4">
                <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                <div class="mt-2">
                  <div class="flex items-center justify-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">workcation.com/</div>
                    <x-input name="username" label="" :value="$user->username" page="profile" />
                  </div>
                </div>
              </div>

              <div class="m-0 col-span-full">
                <label for="about" class="block text-sm/6 font-medium text-gray-900">A propos</label>
                <div class="relative mt-2">
                    <x-textarea name="infos" label="" rows="3"> {{$user->infos}} </x-textarea>

                </div>
              </div>

              <div class="col-span-full">
                <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                <div class="relative mt-2 flex items-center gap-x-3">
                    <img src="{{asset('storage/' . $user->photo)}}" class="mt-2 border-2 border-solid border-black rounded-full mb-4 h-12 w-12 size-12 text-gray-300">

            <x-input name="photo" type="file" label="" :value="$user->photo" page="profile" />
                </div>
              </div>


            </div>
          </div>

          <div class="border-b border-gray-900/10 pb-12 mt-10">
            <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Prenom</label>
                <div class="mt-2">
                  <x-input name="prenom" label="" :value="$prenom" page="profile"/>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Nom</label>
                <div class="mt-2">
                    <x-input name="name" label="" :value="$name" page="profile"/>
                </div>
              </div>

              <div class="sm:col-span-4">
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <x-input name="email" type="email" label="" :value="$user->email" page="profile"/>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="country" class="block text-sm/6 font-medium text-gray-900">Pays</label>
                <div class="grid grid-cols-1">
                  <x-select id="pays" name="pays" label="" :value="$user->pays" :list="$pays" page="profile"/>
                </div>
              </div>

              <div class="col-span-full">
                <label for="street-address" class="block text-sm/6 font-medium text-gray-900">Adresse</label>
                <div class="mt-2">
                    <x-input name="adresse" label="" :value="$user->adresse" page="profile"/>
                </div>
              </div>

              <div class="col-span-full">
                <x-select id="ville" name="ville" label="Ville" page="profile"/>
                <x-input id="city_other" :value="$user->ville" name="city_other" label="" placeholder="Entrez votre ville" page="profile"/>
              </div>


        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
      </form>



      <script>
        // Liste des villes pour chaque pays (ceci est un exemple simplifié)
        const citiesData = {
            France: ['Paris', 'Lyon', 'Marseille'],
            Espagne: ['Barcelone', 'Madrid', 'Séville'],
            Usa: ['NY', 'Chicago', 'Détroit'],
            Maroc: ['Rabat', 'Safi', 'Casablanca']
        };

        // Fonction pour mettre à jour les villes
        function updateCities() {
            const countryId = document.getElementById('pays').value;
            const citySelect = document.getElementById('ville');
            const cityOtherInput = document.getElementById('city_other');
            const selectedCity = "{{ old('ville', $user->ville) }}";

            // Réinitialiser les options de ville
            citySelect.innerHTML = '<option value="">Sélectionner une ville</option>';

            // Cacher le champ "autre" si un pays est sélectionné
            cityOtherInput.style.display = 'none';

            // Si l'utilisateur a sélectionné "Autre", afficher le champ texte pour la ville
            if (countryId === 'Autre') {
                cityOtherInput.style.display = 'block';
            } else if (countryId) {
                // Afficher les villes en fonction du pays sélectionné
                const cities = citiesData[countryId] || [];
                cities.forEach(function(ville) {
                    const option = document.createElement('option');
                    option.value = ville;
                    if(selectedCity === ville){
                        option.selected = true;}
                    option.textContent = ville;
                    citySelect.appendChild(option);
                });
            }
        }

        // Écouter les changements sur le sélecteur de pays
        document.getElementById('pays').addEventListener('change', updateCities);
        updateCities();
        </script>


</x-default-layout>
