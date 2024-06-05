<div class="block mt-2 mb-2">

    <h1 class="text-xl mb-3">{{ $question->question }}</h1>

    @foreach ($question->options as $qo )

    <div wire:click="saveAnswer({{$question->id}}, {{ $qo->id}})" class="block mt-1 p-2 border border-gray-300 my-1 hover:bg-blue-300 @if ($qo->answer_id !=null)  bg-blue-700  @endif">
        <h2>{{ $qo->option }}</h2>
    </div>
    @endforeach
</div>
