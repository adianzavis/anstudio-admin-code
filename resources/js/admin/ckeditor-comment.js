import ClassicEditor from "@ckeditor/ckeditor5-editor-classic/src/classiceditor";
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

console.log(ClassicEditor);
let editorConfig = {
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
};

cash(".comment").each(function () {
    let editor = ClassicEditor;
    let options = editorConfig;
    let el = this;

    if (cash(el).data("editor") == "inline") {
        editor = InlineEditor;
    } else if (cash(el).data("editor") == "balloon") {
        editor = BalloonEditor;
    } else if (cash(el).data("editor") == "document") {
        editor = DocumentEditor;
        el = cash(el).find(".document-editor__editable")[0];
    }

    editor.create(el, options);

    if (cash(el).closest(".editor").data("editor") == "document") {
        cash(el)
            .closest(".editor")
            .find(".document-editor__toolbar")
            .append(editor.ui.view.toolbar.element);
    }

});
