@extends('layouts.client')
@section('css')
<style type="text/css">
.mcq .mcq-answer {
    position: relative;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: flex-start;
    -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
    background: #F5F5F5;
    border: 1px solid #CCC;
    border-radius: 4px;
    padding-right: 120px;
}
.mcq .circle {
    position: relative;
    height: 1em;
    width: 1em;
    margin-left: 1em;
    flex: 0 0 auto;
    border-radius: 50%;
    border: 0.3em solid #666677;
    background-color: transparent;
}
.mcq .mcq-answer p {
    display: block;
    margin: 1em;
    z-index: 10;
}
.mcq .highlight {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
.mcq input { display: none;}
.mcq .mcq-answer p { z-index: 1000;}
.mcq input:hover ~ .background { background-color: #efefef;}
.mcq .righthighlight { 
    background-color: #74ef41;
    width: 100%;
    position: absolute;
    height: 100%;
    border-radius: 3px;
}
.mcq .rightcircle {background-color: #d6e9c6; border-color: #3c763d;}
.mcq .highlight { background-color: #f2dede;}
.mcq .circlebox {background-color: #ebccd1; border-color: #a94442;}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('client.test.store') }}">
                @csrf
                @foreach($questions as $question)
                    <div class="card @if(!$loop->last)mb-3 @endif">
                        <div class="card-header">{{ $question->question_text }}</div>
                        <div class="card-body">
                            <input type="hidden" name="questions[{{ $question->id }}]" value="">
                            @foreach($question->questionOptions as $option)
                                <div class="mcq">
                                    <label class="mcq-answer">
                                      <input type="radio" class="answer disable{{ $question->id}}" name="questions[{{ $question->id }}]" id="option-{{ $option->id }}" data-id="{{ $option->id }}" data-quesid="{{ $question->id }}" value="{{ $option->id }}" @if(old("questions.$question->id") == $option->id) checked @endif>
                                      <div class="background-{{ $option->id }}"></div>
                                      <div class="circle circle-{{ $option->id }}"></div>
                                      <p>{{ $option->option_text }}</p>
                                    </label>
                                </div>
                            @endforeach

                            @if($errors->has("questions.$question->id"))
                                <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                    <strong>{{ $errors->first("questions.$question->id") }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
                @if ($questions->onFirstPage())
                <a type="button" class="btn btn-primary" href="{{ $questions->nextPageUrl() }}">Next</a>
                @elseif($questions->hasMorePages())
                <a type="button" class="btn btn-primary" href="{{ $questions->previousPageUrl() }}">Previous</a>&emsp;
                <a type="button" class="btn btn-primary" href="{{ $questions->nextPageUrl() }}">Next</a>
                @else
                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.answer',function(){
        var id  = $(this).attr('data-id')
        var quesid  = $(this).attr('data-quesid')
        $('input.disable'+quesid).attr("disabled", true);
        $("#option-"+id).ready(function(){
            $.ajax({
                url: "{{ url('getdata') }}"+'/'+id,
                type:"GET",
                async: false,
                success: function(data){
                    Success = true;
                    if(data.checked.points == 1){
                        $(".background-"+data.checked.id).addClass("righthighlight");
                        $(".circle-"+data.checked.id).addClass("rightcircle");
                    }else{
                        $(".background-"+data.checked.id).addClass("highlight");
                        $(".circle-"+data.checked.id).addClass("circlebox");
                    }
                    if(data.correct.points == 1){
                        $(".background-"+data.correct.id).addClass("righthighlight");
                        $(".circle-"+data.correct.id).addClass("rightcircle");
                    }else{
                        $(".background-"+data.correct.id).addClass("highlight");
                        $(".circle-"+data.correct.id).addClass("circlebox");
                    }
                },
                error: function(data){
                    Success = false;
                }
            })
        })
    })
        
</script>
@endsection