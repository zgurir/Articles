<x-auth-layout title="Connexion" :action="route('login')" pageTitle="Sign in">
                   <x-input name="email" label="Email" placeholder="Enter Email" /> 
              <x-input name="password" label="Mot de passe" type="password" placeholder="Entrez le mot de passe" />  
                  <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
                <div class="flex items-center">
                  <input id="remember" name="remember" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                  <label for="remember" class="ml-3 block text-sm text-gray-800">
                    Remember me
                  </label>
                </div>
                <div>
                  <a href="jajvascript:void(0);" class="text-blue-600 font-semibold text-sm hover:underline">
                    Forgot Password?
                  </a>
                </div>
              </div>
              </x-auth-layout>