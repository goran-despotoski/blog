import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

/**
 * in order for the element to work with normaln form submit (no ajax), we set a hidden input field where we set the
 * json value of the
 */
new Editor({
    element: document.querySelector('.tiptap-text-editor'),
    extensions: [
        StarterKit,
    ],
    content: JSON.parse(document.querySelector('.text-editor-content').value),
    onUpdate({ editor }) {
        document.querySelector('.text-editor-content').value = JSON.stringify(editor.getJSON());
    },
})
