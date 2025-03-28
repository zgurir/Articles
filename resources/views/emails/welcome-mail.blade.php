<x-mail::message>
Bonjour {{$username}},

Merci de vous être inscrit sur {{ config('app.name') }} ! Nous sommes ravis de vous accueillir dans notre communauté.

Votre compte a été créé avec succès, et vous pouvez maintenant profiter de toutes les fonctionnalités de notre blog : lire des articles exclusifs, interagir avec les autres membres et rester informé des dernières nouveautés.

Voici quelques informations pour bien démarrer : <br>
Nom d'utilisateur : {{$username}}

Adresse e-mail associée : {{$useremail}}

Lien vers votre profil : <a href="{{ route('home.profile') }}"> profile </a>

Premiers articles à découvrir : <a href="{{ route('home') }}"> articles </a>

Que faire ensuite ?
Complétez votre profil : N'oubliez pas de personnaliser votre profil pour vous faire connaître de la communauté.

Participez à la discussion : N'hésitez pas à commenter nos articles et à partager vos idées avec les autres utilisateurs.

Encore une fois, bienvenue parmi nous ! Nous sommes impatients de vous voir participer activement et de partager des moments intéressants avec vous.

À bientôt sur {{ config('app.name') }} !

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
