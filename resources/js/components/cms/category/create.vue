<template>
    <div class="card card-default">
        <div class="card-header">Add New Category</div>
        <div class="card-body">
            
            <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
    data(){
        return {
            editor: ClassicEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                // The configuration of the editor.
            }
        }
    }
}
</script>
