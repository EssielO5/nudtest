<x-mail::message>
# Mail de Nùdutin App

- Nom : {{ $data['name'] }}
- Contact : {{ $data['phone'] }}
- Email : {{ $data['email'] }}
- Adresse : {{ $data['location'] }}

**Message :** <br>
{{ $data['subject'] }}


</x-mail::message>
