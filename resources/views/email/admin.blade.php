<x-mail::message>
# Mail de Nùdutin App

Bonjour cher Admin

- Nom : {{ $data['name'] }}
- Email : {{ $data['email'] }}

**Message :** <br>
{{ $data['subject'] }}


</x-mail::message>
