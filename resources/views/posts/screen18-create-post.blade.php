@extends('layout')
@section('content')
<div class = "post-crt-body">
    <h1 class = "PostCreateTitle">Create a new post</h1>
    <form action="{{url('post/save')}}" method="post">
        @csrf
        <div class = "post-option">
            <div class = "option">
                <label for="postTitle">Title</label>
                <input id="postTitle" maxlength="255" class="input-form" name="postTitle" placeholder="..." required>
            </div>
            <div class = "option">
                <label for="postCategoryPet">Pet</label>
                <select id="postCategoryPet" class="input-form" name="postCategoryPet">
                    @foreach($allCategoryPet as $categoryPet)
                        <option value="{{$categoryPet->id}}">{{$categoryPet->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class = "option">
                <label for="postCategory">Category</label>
                <select id="postCategory" class="input-form" name="postCategory">
                    @foreach($allCategory as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class = "post-submit">
            <button type="submit" id="createPostSubmitButton" class="post-button">Create</button>
        </div>
        <label for="postContent">Content</label>
        <textarea id="postContent" name="postContent" class = "post-content" hidden></textarea>
        <div>
{{--            <textarea id="postContent" name="postContent" class = "post-content"></textarea>--}}
            <div class="sample-toolbar">
                <a href="javascript:void(0)" onclick="format('bold')"><span class="fa fa-bold fa-fw"></span></a>
                <a href="javascript:void(0)" onclick="format('italic')"><span class="fa fa-italic fa-fw"></span></a>
                <a href="javascript:void(0)" onclick="format('insertunorderedlist')"><span class="fa fa-list fa-fw"></span></a>
                <a href="javascript:void(0)" onclick="setUrl()"><span class="fa fa-link fa-fw"></span></a>
                <span><input id="txtFormatUrl" placeholder="url" class="form-control"></span>
            </div>

            <div class="editor" id="sampleEditor">
            </div>

        </div>
    </form>
</div>

<script>
    window.addEventListener('load', function(){
        document.getElementById('sampleEditor').setAttribute('contenteditable', 'true');
    });

    function format(command, value) {
        document.execCommand(command, false, value);
    }

    function setUrl() {
        var url = document.getElementById('txtFormatUrl').value;
        var sText = document.getSelection();
        document.execCommand('insertHTML', false, '<a href="' + url + '" target="_blank">' + sText + '</a>');
        document.getElementById('txtFormatUrl').value = '';
    }

</script>

@endsection
