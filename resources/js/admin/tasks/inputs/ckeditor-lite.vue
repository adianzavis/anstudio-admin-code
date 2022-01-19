<template>
    <ckeditor v-model="_value" :editor="editor" :config="editorConfig" class="validate-input"/>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import CKEditor from '@ckeditor/ckeditor5-vue';

import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Autoformat from '@ckeditor/ckeditor5-autoformat/src/autoformat';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote';
import Heading from '@ckeditor/ckeditor5-heading/src/heading';
import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload';
import Link from '@ckeditor/ckeditor5-link/src/link';
import ListStyle from '@ckeditor/ckeditor5-list/src/list';
import Font from "@ckeditor/ckeditor5-font/src/font";
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter';

export default {
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                toolbarStartupExpanded: false,
                plugins: [
                    Essentials,
                    Autoformat,
                    Alignment,
                    Bold,
                    Italic,
                    BlockQuote,
                    Heading,
                    Image,
                    ImageCaption,
                    ImageStyle,
                    ImageToolbar,
                    ImageUpload,
                    Link,
                    ListStyle,
                    Font,
                    Paragraph,
                    SimpleUploadAdapter,
                ],
                toolbar: {
                    items: [
                        "fontSize",
                        "fontColor",
                        "fontBackgroundColor",
                        "bold",
                        "italic",
                        "underline",
                        "strikethrough",
                        "code",
                        "subscript",
                        "superscript",
                        "bulletedList",
                        "numberedList",
                        "alignment",
                        "link",
                        "undo",
                        "redo",
                        "fontFamily",
                        "highlight",
                        "|",
                        "imageUpload",
                    ],
                },
                alignment: {
                    options: [ 'left', 'right', 'center' ],
                },
                fontFamily: {
                    options: [
                        '"roc-grotesk", sans-serif',
                        '"franklin-gothic-atf", sans-serif',
                    ]
                },
                fontColor: {
                    colors: [
                        {
                            color: 'hsl(0, 0%, 0%)',
                            label: 'Black'
                        },
                        {
                            color: 'hsl(0, 0%, 30%)',
                            label: 'Dim grey'
                        },
                        {
                            color: 'hsl(0, 0%, 60%)',
                            label: 'Grey'
                        },
                        {
                            color: 'hsl(0, 0%, 90%)',
                            label: 'Light grey'
                        },
                        {
                            color: 'hsl(0, 0%, 100%)',
                            label: 'White',
                        },
                    ]
                },
                fontBackgroundColor: {
                    colors: [
                        {
                            color: 'hsl(0, 0%, 0%)',
                            label: 'Black'
                        },
                        {
                            color: 'hsl(0, 0%, 30%)',
                            label: 'Dim grey'
                        },
                        {
                            color: 'hsl(0, 0%, 60%)',
                            label: 'Grey'
                        },
                        {
                            color: 'hsl(0, 0%, 90%)',
                            label: 'Light grey'
                        },
                        {
                            color: 'hsl(0, 0%, 100%)',
                            label: 'White',
                        },
                    ]
                },
                simpleUpload: {
                    uploadUrl: '/admin/ckeditor/upload',
                    withCredentials: true,
                    headers: {
                        '_token': document.querySelector('[name="_token"]').value,
                    }
                },
            }
        }
    },
    computed : {
        _value : {
            get : function () {
                return this.value
            },
            set : function(val) {
                this.$emit('input', val)
            }
        },
    },
    props : ['value'],
    components: {
        ckeditor: CKEditor.component,
    }
}
</script>
