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
                <a href="javascript:void(0)" onclick="format('bold')">
                    <div class="editor-button" id="bold">
                        <span class="fa fa-bold fa-fw"></span>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('italic')">
                    <div class="editor-button">
                        <span class="fa fa-italic fa-fw"></span>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('Underline')">
                    <div class="editor-button">
                        <i class="fas fa-underline"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('Strikethrough')">
                    <div class="editor-button">
                        <i class="fas fa-strikethrough"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('Subscript')">
                    <div class="editor-button" id="subScript">
                        <i class="fas fa-subscript"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('Superscript')">
                    <div class="editor-button" id="superScript">
                        <i class="fas fa-superscript"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('removeFormat')">
                    <div class="editor-button">
                        <i class="fas fa-remove-format"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('insertOrderedlist')">
                    <div class="editor-button" id="insertOrderedlist">
                        <i class="fas fa-list-ol"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('insertUnorderedlist')">
                    <div class="editor-button" id="insertUnorderedlist">
                        <i class="fas fa-list"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('indent')">
                    <div class="editor-button">
                        <i class="fas fa-indent"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('justifyLeft')">
                    <div class="editor-button clicked" id="justifyLeft">
                        <i class="fas fa-align-left"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('justifyCenter')">
                    <div class="editor-button" id="justifyCenter">
                        <i class="fas fa-align-center"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('justifyRight')">
                    <div class="editor-button" id="justifyRight">
                        <i class="fas fa-align-right"></i>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('justifyFull')">
                    <div class="editor-button" id="justifyFull">
                        <i class="fas fa-align-justify"></i>
                    </div>
                </a>
{{--                <a href="javascript:void(0)" onclick="format('insertImage')">--}}
{{--                    <div class="editor-button">--}}
{{--                        <i class="fas fa-image"></i>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <a href="javascript:void(0)" onclick="format('enableInlineTableEditing')">--}}
{{--                    <div class="editor-button">--}}
{{--                        <i class="fas fa-image"></i>--}}
{{--                    </div>--}}
{{--                </a>--}}

                <a href="javascript:void(0)" onclick="setUrl()">
                    <div class="editor-button">
                        <span class="fa fa-link fa-fw"></span>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="format('undo')">
                    <div class="editor-button" id="undo">
                        <i class="fas fa-undo"></i>
                    </div>
                </a>
                <span><input id="txtFormatUrl" placeholder="url" class="form-control"></span>
            </div>

            <div class="editor" id="sampleEditor">
            </div>

        </div>
    </form>
</div>

<script>
    let isSubscript = false;
    let isSuperscript = false;
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
