@foreach($children as $childs)
        <option value="{{ $childs->id }}">{{'-'.$childs->title }}</option>
    @if($childs->childs)
        @foreach($childs->childs as $sh)
            <option value="{{ $sh->id }}">{{'-' . $sh->title . " (род.категория-> " . $childs->title . ")" }}</option>
        @endforeach
    @endif
@endforeach