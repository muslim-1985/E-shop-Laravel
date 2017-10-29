@foreach($children as $childs)
    {{-- отключаем возможность выбора самой себя --}}
    @if($category->id === $childs->id)
        <option disabled>{{ $childs->title . " (категория не может ссылаться на саму себя)" }}</option>
        @else
        <option value="{{ $childs->id }}">{{'-'.$childs->title }}</option>
    @endif
    {{--создаем еще один уровень вложенности (рекурсию не стал применять много ресурсов потребляет)--}}
    @if($childs->childs)
        @foreach($childs->childs as $sh)
            <option value="" disabled>{{'-' . $sh->title . " (род.категория: " . $childs->title . " ::достигнут лимит уровня вложенности)" }}</option>
        @endforeach
    @endif
@endforeach