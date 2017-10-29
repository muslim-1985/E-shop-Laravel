@foreach($children as $childs)
        <option value="{{ $childs->id }}">{{'-'.$childs->title }}</option>
    @if($childs->childs)
        @foreach($childs->childs as $sh)
            <option value="" disabled>{{'-' . $sh->title . " (род.категория: " . $childs->title . " ::достигнут лимит уровня вложенности)" }}</option>
        @endforeach
    @endif
@endforeach